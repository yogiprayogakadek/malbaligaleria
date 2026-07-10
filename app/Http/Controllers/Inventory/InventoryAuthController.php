<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\SubdomainUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryAuthController extends Controller
{
    // ── Login ──────────────────────────────────────────────────────────────

    public function showLogin()
    {
        return view('inventory.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        $user = Auth::user();

        // Superusers always pass
        if ($user->hasRole('superuser')) {
            $request->session()->regenerate();
            return redirect()->intended(route('inventory.index'));
        }

        // Check if user is active & has inventory access
        if (!$user->is_active || $user->status !== 'approved') {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda tidak aktif atau belum disetujui.']);
        }

        $hasAccess = SubdomainUser::where('user_id', $user->id)
            ->where('subdomain', 'inventory')
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->exists();

        if (!$hasAccess) {
            Auth::logout();
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Anda tidak memiliki akses ke sistem Inventory. Hubungi administrator.']);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('inventory.index'));
    }

    // ── Logout ─────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inventory.login');
    }

    // ── Error Pages ────────────────────────────────────────────────────────

    public function accessDenied()
    {
        return view('inventory.auth.access-denied');
    }

    public function ipBlocked()
    {
        return view('inventory.auth.ip-blocked', [
            'ip' => session('blocked_ip', request()->ip()),
        ]);
    }
}
