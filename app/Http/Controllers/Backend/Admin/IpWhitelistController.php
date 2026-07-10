<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpWhitelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class IpWhitelistController extends Controller
{
    // ── Index ────────────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = IpWhitelist::with('creator')->select('ip_whitelists.*');

            if ($request->filled('subdomain')) {
                $query->where('subdomain', $request->subdomain);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('added_by', fn($r) => $r->creator ? $r->creator->name : '-')
                ->editColumn('is_active', function ($r) {
                    $label = $r->is_active ? 'Active' : 'Inactive';
                    $color = $r->is_active ? 'success' : 'secondary';
                    return "<span class=\"badge bg-{$color}\">{$label}</span>";
                })
                ->addColumn('action', function ($r) {
                    $toggle = $r->is_active
                        ? "<button class=\"btn btn-sm btn-warning btn-toggle me-1\" data-id=\"{$r->id}\"><i class=\"ti ti-player-pause\"></i></button>"
                        : "<button class=\"btn btn-sm btn-success btn-toggle me-1\" data-id=\"{$r->id}\"><i class=\"ti ti-player-play\"></i></button>";
                    $edit = "<a href=\"" . route('admin.ip-whitelist.edit', $r->id) . "\" class=\"btn btn-sm btn-primary me-1\"><i class=\"ti ti-pencil\"></i></a>";
                    $del  = "<button class=\"btn btn-sm btn-danger btn-delete\" data-id=\"{$r->id}\" data-ip=\"" . htmlspecialchars($r->ip_address) . "\"><i class=\"ti ti-trash\"></i></button>";
                    return $toggle . $edit . $del;
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        $subdomains = IpWhitelist::distinct()->pluck('subdomain');
        $activeCount = IpWhitelist::where('subdomain', 'inventory')->where('is_active', true)->count();
        return view('backend.admin.ip-whitelist.index', compact('subdomains', 'activeCount'));
    }

    // ── Create / Store ───────────────────────────────────────────────────────

    public function create()
    {
        $subdomains = ['inventory'];
        return view('backend.admin.ip-whitelist.create', compact('subdomains'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subdomain'  => 'required|string|max:50',
            'ip_address' => [
                'required',
                'string',
                'max:45',
                'regex:/^(\d{1,3}\.){3}\d{1,3}$|^([0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}$/',
                function ($attr, $val, $fail) use ($request) {
                    $exists = IpWhitelist::where('subdomain', $request->subdomain)
                        ->where('ip_address', $val)->exists();
                    if ($exists) $fail('IP ini sudah terdaftar untuk subdomain tersebut.');
                }
            ],
            'label'      => 'nullable|string|max:100',
        ]);

        IpWhitelist::create(array_merge($data, [
            'is_active'  => true,
            'created_by' => Auth::id(),
        ]));

        return redirect()->route('admin.ip-whitelist.index')
            ->with('success', 'IP berhasil ditambahkan ke whitelist.');
    }

    // ── Edit / Update ────────────────────────────────────────────────────────

    public function edit($id)
    {
        $ip = IpWhitelist::findOrFail($id);
        $subdomains = ['inventory'];
        return view('backend.admin.ip-whitelist.edit', compact('ip', 'subdomains'));
    }

    public function update(Request $request, $id)
    {
        $ip = IpWhitelist::findOrFail($id);

        $data = $request->validate([
            'subdomain'  => 'required|string|max:50',
            'ip_address' => [
                'required', 'string', 'max:45',
                'regex:/^(\d{1,3}\.){3}\d{1,3}$|^([0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}$/',
                function ($attr, $val, $fail) use ($request, $id) {
                    $exists = IpWhitelist::where('subdomain', $request->subdomain)
                        ->where('ip_address', $val)->where('id', '!=', $id)->exists();
                    if ($exists) $fail('IP ini sudah terdaftar untuk subdomain tersebut.');
                }
            ],
            'label' => 'nullable|string|max:100',
        ]);

        $ip->update($data);
        return redirect()->route('admin.ip-whitelist.index')
            ->with('success', 'IP whitelist berhasil diperbarui.');
    }

    // ── Toggle active ────────────────────────────────────────────────────────

    public function toggle($id)
    {
        $ip = IpWhitelist::findOrFail($id);
        $ip->update(['is_active' => !$ip->is_active]);
        return response()->json(['success' => true, 'is_active' => $ip->is_active]);
    }

    // ── Destroy ──────────────────────────────────────────────────────────────

    public function destroy($id)
    {
        IpWhitelist::findOrFail($id)->delete();
        return response()->json(['success' => 'IP berhasil dihapus dari whitelist.']);
    }
}
