<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $code = \App\Helpers\CaptchaHelper::generateCode();
        session(['login_captcha' => strtolower($code)]);

        return Inertia::render('Admin/Login', [
            'captcha_image' => \App\Helpers\CaptchaHelper::generateSvg($code),
        ]);
    }

    public function refreshCaptcha()
    {
        $code = \App\Helpers\CaptchaHelper::generateCode();
        session(['login_captcha' => strtolower($code)]);

        return response()->json([
            'captcha_image' => \App\Helpers\CaptchaHelper::generateSvg($code),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'captcha' => ['required', 'string'],
        ], [
            'captcha.required' => 'Kolom captcha wajib diisi.',
        ]);

        if (strtolower($request->input('captcha')) !== session('login_captcha')) {
            $newCode = \App\Helpers\CaptchaHelper::generateCode();
            session(['login_captcha' => strtolower($newCode)]);

            return back()
                ->withInput($request->except('captcha'))
                ->withErrors(['captcha' => 'Captcha yang Anda masukkan salah.']);
        }

        // We only attempt auth with email and password
        $authCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/panel-umkm');
        }

        // Generate new captcha on failed attempt
        $newCode = \App\Helpers\CaptchaHelper::generateCode();
        session(['login_captcha' => strtolower($newCode)]);

        return back()
            ->withInput($request->except('captcha'))
            ->withErrors([
                'email' => 'Email atau password tidak sesuai.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/cms-login');
    }
}
