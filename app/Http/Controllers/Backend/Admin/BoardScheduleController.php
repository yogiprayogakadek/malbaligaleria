<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardSchedule;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class BoardScheduleController extends Controller
{
    /**
     * Check if the authenticated user has access to the board.
     */
    private function checkAccess(): bool
    {
        $user = auth()->user();

        if ($user->hasRole('superuser')) {
            return true;
        }

        $setting = Setting::where('pages', 'dashboard_menu')
            ->where('name', 'calendar_kanban_visibility')
            ->where('is_active', true)
            ->first();

        if (!$setting) {
            return false;
        }

        $payload = $setting->payload ?? [];

        // Check "all_roles" flag
        if (!empty($payload['all_roles'])) {
            return true;
        }

        // Check by specific user ID
        $allowedUsers = $payload['users'] ?? [];
        if (in_array($user->id, $allowedUsers)) {
            return true;
        }

        // Check by role
        $allowedRoles = $payload['roles'] ?? [];
        foreach ($allowedRoles as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Render the Event Board page.
     */
    public function board(Request $request)
    {
        if (!$this->checkAccess()) {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();
        $isSuperUser = $user->hasRole('superuser');

        $setting = Setting::where('pages', 'dashboard_menu')
            ->where('name', 'calendar_kanban_visibility')
            ->where('is_active', true)
            ->first();

        $payload = $setting ? ($setting->payload ?? []) : [];
        $allowedRoles   = $payload['roles'] ?? [];
        $allowedUserIds = $payload['users'] ?? [];
        $allRoles       = $payload['all_roles'] ?? false;

        $allRolesList = ['admin', 'hr', 'tenant'];

        // Load selected users for display
        $selectedUsers = User::whereIn('id', $allowedUserIds)
            ->select('id', 'name', 'email')
            ->get();

        return view('backend.admin.board.index', compact(
            'isSuperUser',
            'allowedRoles',
            'allowedUserIds',
            'allRoles',
            'allRolesList',
            'selectedUsers'
        ));
    }

    /**
     * Return all schedules in FullCalendar-compatible JSON format.
     */
    public function apiList(Request $request)
    {
        if (!$this->checkAccess()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $query = BoardSchedule::with('creator');

        if ($request->has('start') && $request->has('end')) {
            $start = substr($request->start, 0, 10);
            $end   = substr($request->end, 0, 10);
            $query->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->where('start_date', '<=', $start)
                         ->where('end_date', '>=', $end);
                  });
            });
        }

        $schedules = $query->get();

        $formatted = $schedules->map(function ($s) {
            $isAllDay = empty($s->start_time);

            $start = $s->start_date->format('Y-m-d');
            if ($s->start_time) {
                $start .= 'T' . $s->start_time;
            }

            // Actual end date stored in DB (inclusive)
            $actualEndDate = $s->end_date ? $s->end_date->format('Y-m-d') : $s->start_date->format('Y-m-d');

            // FullCalendar requires exclusive end for all-day events (+1 day)
            if ($isAllDay) {
                $fcEndDate = \Carbon\Carbon::parse($actualEndDate)->addDay()->format('Y-m-d');
                $end = $fcEndDate;
            } else {
                $end = $actualEndDate;
                if ($s->end_time) {
                    $end .= 'T' . $s->end_time;
                }
            }

            return [
                'id'              => $s->uuid,
                'title'           => $s->title,
                'start'           => $start,
                'end'             => $end,
                'allDay'          => $isAllDay,
                'backgroundColor' => $s->color . '22',
                'borderColor'     => $s->color,
                'textColor'       => $this->darkenColor($s->color),
                'extendedProps'   => [
                    'uuid'        => $s->uuid,
                    'description' => $s->description,
                    'location'    => $s->location,
                    'column'      => $s->column,
                    'color'       => $s->color,
                    'created_by'  => $s->creator ? $s->creator->name : '-',
                    // Store actual (inclusive) dates as plain strings for modal use
                    'actual_start_date' => $s->start_date->format('Y-m-d'),
                    'actual_end_date'   => $actualEndDate,
                    'start_time'  => $s->start_time ? substr($s->start_time, 0, 5) : '',
                    'end_time'    => $s->end_time ? substr($s->end_time, 0, 5) : '',
                ],
            ];
        });

        return response()->json($formatted);
    }


    /**
     * Store a new schedule via AJAX.
     */
    public function apiStore(Request $request)
    {
        if (!$this->checkAccess()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title'      => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'   => 'nullable|date_format:H:i',
            'color'      => 'nullable|string|max:20',
            'column'     => 'nullable|in:draft,todo,in_progress,done',
        ]);

        $schedule = BoardSchedule::create([
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date ?: $request->start_date,
            'start_time'  => $request->start_time ? $request->start_time . ':00' : null,
            'end_time'    => $request->end_time ? $request->end_time . ':00' : null,
            'color'       => $request->color ?? '#5d87ff',
            'column'      => $request->column ?? 'todo',
            'created_by'  => auth()->id(),
        ]);

        return response()->json([
            'success'  => true,
            'message'  => 'Schedule created successfully.',
            'schedule' => $schedule,
        ]);
    }

    /**
     * Update a schedule via AJAX.
     */
    public function apiUpdate(Request $request, $uuid)
    {
        if (!$this->checkAccess()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $schedule = BoardSchedule::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'title'      => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'   => 'nullable|date_format:H:i',
            'color'      => 'nullable|string|max:20',
            'column'     => 'nullable|in:draft,todo,in_progress,done',
        ]);

        $schedule->update([
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date ?: $request->start_date,
            'start_time'  => $request->start_time ? $request->start_time . ':00' : null,
            'end_time'    => $request->end_time ? $request->end_time . ':00' : null,
            'color'       => $request->color ?? $schedule->color,
            'column'      => $request->column ?? $schedule->column,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Schedule updated successfully.',
        ]);
    }

    /**
     * Reschedule via calendar drag-and-drop.
     */
    public function apiUpdateDate(Request $request, $uuid)
    {
        if (!$this->checkAccess()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'start_date' => 'required',
            'end_date'   => 'nullable',
        ]);

        $schedule = BoardSchedule::where('uuid', $uuid)->firstOrFail();

        $startStr = $request->start_date;
        $endStr   = $request->end_date;

        $startDate = substr($startStr, 0, 10);
        $startTime = str_contains($startStr, 'T') ? substr($startStr, 11, 8) : null;

        $schedule->start_date = $startDate;
        if ($startTime) {
            $schedule->start_time = $startTime;
        }

        if ($endStr) {
            $endDate = substr($endStr, 0, 10);
            $endTime = str_contains($endStr, 'T') ? substr($endStr, 11, 8) : null;
            $schedule->end_date = $endDate;
            if ($endTime) {
                $schedule->end_time = $endTime;
            }
        } else {
            $schedule->end_date = $startDate;
        }

        $schedule->save();

        return response()->json([
            'success' => true,
            'message' => 'Schedule rescheduled successfully.',
        ]);
    }

    /**
     * Move to Kanban column via drag-and-drop.
     */
    public function apiUpdateKanban(Request $request, $uuid)
    {
        if (!$this->checkAccess()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'column' => 'required|in:draft,todo,in_progress,done',
        ]);

        $schedule = BoardSchedule::where('uuid', $uuid)->firstOrFail();
        $schedule->column = $request->column;
        $schedule->save();

        return response()->json([
            'success' => true,
            'message' => 'Schedule moved successfully.',
        ]);
    }

    /**
     * Delete a schedule via AJAX.
     */
    public function apiDelete($uuid)
    {
        if (!$this->checkAccess()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $schedule = BoardSchedule::where('uuid', $uuid)->firstOrFail();
        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Schedule deleted successfully.',
        ]);
    }

    /**
     * Save visibility settings (superuser only).
     */
    public function saveSettings(Request $request)
    {
        if (!auth()->user()->hasRole('superuser')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $roles    = $request->input('roles', []);
        $userIds  = $request->input('users', []);
        $allRoles = $request->boolean('all_roles', false);

        Setting::updateOrCreate(
            [
                'pages' => 'dashboard_menu',
                'name'  => 'calendar_kanban_visibility',
            ],
            [
                'description' => 'Visibility settings for Event Board (Calendar & Kanban)',
                'type'        => 'custom',
                'is_active'   => true,
                'payload'     => [
                    'all_roles' => $allRoles,
                    'roles'     => $roles,
                    'users'     => array_map('intval', $userIds),
                ],
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Visibility settings saved successfully.',
        ]);
    }

    /**
     * Search users for visibility autocomplete (superuser only).
     */
    public function searchUsers(Request $request)
    {
        if (!auth()->user()->hasRole('superuser')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $q = $request->get('q', '');

        $users = User::where(function ($query) use ($q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
        })
        ->where('is_active', true)
        ->whereNotNull('email_verified_at')
        ->select('id', 'name', 'email')
        ->limit(15)
        ->get();

        return response()->json($users);
    }

    /**
     * Darken a hex color for text contrast.
     */
    private function darkenColor(string $hex): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        // Darken by 40%
        $r = max(0, (int)($r * 0.6));
        $g = max(0, (int)($g * 0.6));
        $b = max(0, (int)($b * 0.6));
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
