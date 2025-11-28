<?php

namespace App\Http\Controllers;

use App\Services\TenantService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function verifyEmail()
    {
        return view('auth.email-verify');
    }

    public function verificationVerify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        $request->user()->update([
            'is_active' => true
        ]);

        return redirect(route('tenant.dashboard'))->with('success', 'Email berhasil diverifikasi. Menunggu persetujuan admin.');
    }

    public function verificationNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
