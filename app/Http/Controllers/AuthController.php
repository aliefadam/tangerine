<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login", [
            "title" => "Login",
        ]);
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt($request->only(["email", "password"]))) {
            $role = Auth::user()->role;
            if ($role == "admin") {
                return redirect()->route("admin.dashboard");
            } else {
                return redirect()->route("gate");
            }
        } else {
            return back()->with("notification", setNotification("error", "Gagal", "Email atau password salah"));
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();
        if ($user) {
            $user->update([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                "role" => "user",
                'password' => bcrypt("{$googleUser->id}-{$googleUser->email}-{$googleUser->name}"),
            ]);
        } else {
            $user = User::create([
                'google_id' => $googleUser->id,
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                "email_verified_at" => now(),
                "role" => "user",
                'password' => bcrypt("{$googleUser->id}-{$googleUser->email}-{$googleUser->name}"),
            ]);
        }

        Auth::login($user);
        return redirect()->route('gate');
        // return redirect()->route('home');
    }

    public function register()
    {
        return view("auth.register", [
            "title" => "Register",
        ]);
    }

    public function register_post(Request $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "password" => bcrypt($request->password),
            "role" => "user",
        ]);

        Auth::login($user);
        event(new Registered($user));
        return redirect()->route("gate");
    }

    public function register_verify()
    {
        return view("auth.verify", [
            "title" => "Verifikasi Email",
        ]);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route("gate");
    }

    public function verificationNotice()
    {
        return view('auth.verify-email', [
            "title" => "Verifikasi Email"
        ]);
    }

    public function sendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('notification', setNotification("success", "Sukses", "Verifikasi Email Telah Dikirim"));
    }

    public function forgot_password()
    {
        return view("auth.forgot-password", [
            "title" => "Lupa Password",
        ]);
    }

    public function forgot_password_post(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if ($user = User::where("email", $request->email)->first()) {
            if ($user->google_id) {
                return back()->with("notification", setNotification("error", "Gagal", "Email ini terdaftar sebagai login google, silahkan login menggunakan google"));
            }
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == "passwords.user") {
            return back()->with("notification", setNotification("error", "Gagal", "Email anda belum terdaftar di situs kami"));
        }

        return redirect()->route("forgot-password-done");
    }

    public function forgot_password_done()
    {
        return view("auth.forgot-password-done", [
            "title" => "Lupa Password",
        ]);
    }

    public function reset_password($token)
    {
        return view("auth.reset-password", [
            "title" => "Reset Password",
            "token" => $token,
        ]);
    }

    public function reset_password_post(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with("notification", setNotification("error", "Gagal", "Konfirmasi password tidak sama"));
        }

        Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return redirect()->route("login")->with("notification", setNotification("success", "Berhasil", "Berhasil Mereset Password, Silahkan Login!"));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
