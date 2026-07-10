<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubdomainUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SubdomainAccessController extends Controller
{
    // ── Index (list) ────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = SubdomainUser::with(['user', 'grantedBy'])
                ->select('subdomain_users.*');

            if ($request->filled('subdomain')) {
                $query->where('subdomain', $request->subdomain);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('user_name', fn($r) => $r->user ? $r->user->name : '-')
                ->addColumn('user_email', fn($r) => $r->user ? $r->user->email : '-')
                ->addColumn('granted_by_name', fn($r) => $r->grantedBy ? $r->grantedBy->name : '-')
                ->editColumn('is_active', function ($r) {
                    $label = $r->is_active ? 'Active' : 'Inactive';
                    $color = $r->is_active ? 'success' : 'secondary';
                    return "<span class=\"badge bg-{$color}\">{$label}</span>";
                })
                ->editColumn('expires_at', function ($r) {
                    if (!$r->expires_at) return '<span class="text-muted">Never</span>';
                    $expired = $r->expires_at->isPast();
                    $color = $expired ? 'danger' : 'warning';
                    return "<span class=\"badge bg-{$color}\">{$r->expires_at->format('d M Y')}</span>";
                })
                ->addColumn('action', function ($r) {
                    $toggle = $r->is_active
                        ? "<button class=\"btn btn-sm btn-warning btn-toggle me-1\" data-id=\"{$r->id}\" title=\"Nonaktifkan\"><i class=\"ti ti-player-pause\"></i></button>"
                        : "<button class=\"btn btn-sm btn-success btn-toggle me-1\" data-id=\"{$r->id}\" title=\"Aktifkan\"><i class=\"ti ti-player-play\"></i></button>";
                    $del = "<button class=\"btn btn-sm btn-danger btn-revoke\" data-id=\"{$r->id}\" data-name=\"" . htmlspecialchars($r->user?->name ?? '-') . "\" title=\"Cabut Akses\"><i class=\"ti ti-trash\"></i></button>";
                    return $toggle . $del;
                })
                ->rawColumns(['is_active', 'expires_at', 'action'])
                ->make(true);
        }

        $subdomains = SubdomainUser::distinct()->pluck('subdomain');
        return view('backend.admin.subdomain-access.index', compact('subdomains'));
    }

    // ── Create / Store ──────────────────────────────────────────────────────

    public function create()
    {
        // List users that don't already have inventory access
        $users = User::orderBy('name')
            ->where('status', 'approved')
            ->whereDoesntHave('subdomainAccess', fn($q) =>
                $q->where('subdomain', 'inventory')->where('is_active', true)
            )
            ->get();

        $subdomains = ['inventory']; // Expand as new subdomains are added
        return view('backend.admin.subdomain-access.create', compact('users', 'subdomains'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'subdomain'  => 'required|string|max:50',
            'expires_at' => 'nullable|date|after:today',
            'note'       => 'nullable|string|max:255',
        ]);

        SubdomainUser::updateOrCreate(
            ['user_id' => $data['user_id'], 'subdomain' => $data['subdomain']],
            [
                'is_active'  => true,
                'expires_at' => $data['expires_at'] ?? null,
                'note'       => $data['note'] ?? null,
                'granted_by' => Auth::id(),
            ]
        );

        return redirect()->route('admin.subdomain-access.index')
            ->with('success', 'Akses subdomain berhasil diberikan.');
    }

    // ── Toggle active ───────────────────────────────────────────────────────

    public function toggle($id)
    {
        $record = SubdomainUser::findOrFail($id);
        $record->update(['is_active' => !$record->is_active]);
        return response()->json(['success' => true, 'is_active' => $record->is_active]);
    }

    // ── Revoke ──────────────────────────────────────────────────────────────

    public function destroy($id)
    {
        SubdomainUser::findOrFail($id)->delete();
        return response()->json(['success' => 'Akses berhasil dicabut.']);
    }
}
