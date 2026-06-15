<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerPage(Request $request)
    {
        if ($this->wantsJson($request)) {

            return $this->jsonResponse(
                false,
                'Use POST method to register.',
                null,
                405
            );
        }

        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->validationError($request, $validator);
        }

        $user = User::create(
            $validator->validated()
        );

        $data = [
            'user' => $user,
        ];

        if ($this->wantsJson($request)) {
            $data['token'] = $user
                ->createToken('auth_token')
                ->plainTextToken;
        }

        return $this->successResponse(
            $request,
            'Account created successfully.',
            'Login-page',
            $data,
            201
        );
    }

    public function loginPage(Request $request)
    {
        if ($this->wantsJson($request)) {

            return $this->jsonResponse(
                false,
                'Use POST method to login.',
                null,
                405
            );
        }

        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationError($request, $validator);
        }

        $credentials = $validator->validated();
        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {

            return $this->errorResponse(
                $request,
                'Invalid email or password.'
            );
        }

        $user = Auth::user();

        if ($this->wantsJson($request)) {

            $token = $user
                ->createToken('auth_token')
                ->plainTextToken;

            return $this->successResponse(
                $request,
                'Welcome back!',
                null,
                [
                    'user' => $user,
                    'token' => $token,
                ]
            );
        }

        $request->session()->regenerate();

        return $this->successResponse(
            $request,
            'Welcome back!',
            'dashboard'
        );
    }

    public function logout(Request $request)
    {
        if ($this->wantsJson($request)) {

            $request->user()?->currentAccessToken()?->delete();

            return $this->successResponse(
                $request,
                'Logged out successfully.'
            );
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('Login-page');
    }

    public function forgotPasswordPage(Request $request)
    {
        if ($this->wantsJson($request)) {

            return $this->jsonResponse(
                false,
                'Use POST method to forgot password.',
                null,
                405
            );
        }

        return view('forgotpassword');
    }

    public function forgotPasswordSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->validationError($request, $validator);
        }

        $validated = $validator->validated();
        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            return $this->errorResponse(
                $request,
                'No account found for this email address.'
            );
        }

        $otp = random_int(100000, 999999);

        DB::table('password_reset_otps')->updateOrInsert(
            ['email' => $user->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now(),
            ]
        );

        Mail::to($user->email)->send(new SendOtpMail($otp));

        if ($this->wantsJson($request)) {
            return $this->successResponse($request, 'An OTP has been sent to your email address.');
        }

        $request->session()->put('otp_email', $user->email);

        return redirect()->route('otp.enter')->with('success', 'An OTP has been sent to your email address.');
    }

    public function otpEnterPage()
    {
        return view('otp-enter');
    }

    public function otpVerifySubmit(Request $request)
    {
        $rules = ['otp' => 'required|numeric|digits:6'];
        if ($this->wantsJson($request)) {
            $rules['email'] = 'required|email';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationError($request, $validator);
        }

        $validated = $validator->validated();
        $email = $this->wantsJson($request) ? $validated['email'] : $request->session()->get('otp_email');

        if (! $this->wantsJson($request) && ! $email) {
            return redirect()->route('forgot-password')->with('error', 'Something went wrong. Please try again.');
        }

        $otpData = DB::table('password_reset_otps')
            ->where('email', $email)
            ->where('otp', $validated['otp'])
            ->first();

        if (! $otpData || now()->isAfter($otpData->expires_at)) {
            return $this->errorResponse($request, 'Invalid or expired OTP.');
        }

        if ($this->wantsJson($request)) {
            return $this->successResponse($request, 'OTP verified successfully. You can now reset your password.');
        }

        $request->session()->put('otp_verified_email', $email);
        $request->session()->forget('otp_email');

        return $this->successResponse(
            $request,
            'OTP verified successfully.',
            'password.reset'
        );
    }

    public function resetPasswordPage(Request $request)
    {
        if (! $request->session()->has('otp_verified_email')) {
            return redirect()->route('forgot-password-page')->with('error', 'You must verify OTP first.');
        }

        return view('reset-password');
    }

    public function resetPasswordSubmit(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|confirmed',
        ];

        if ($this->wantsJson($request)) {
            $rules['email'] = 'required|email';
            $rules['otp'] = 'required|numeric|digits:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationError($request, $validator);
        }

        $validated = $validator->validated();
        $email = $this->wantsJson($request) ? $validated['email'] : $request->session()->get('otp_verified_email');

        if (! $this->wantsJson($request) && ! $email) {
            return redirect()->route('forgot-password')->with('error', 'You must verify OTP first.');
        }

        if ($this->wantsJson($request)) {
            $otpData = DB::table('password_reset_otps')
                ->where('email', $email)
                ->where('otp', $validated['otp'])
                ->first();

            if (! $otpData || now()->isAfter($otpData->expires_at)) {
                return $this->errorResponse($request, 'Invalid or expired OTP.');
            }
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return $this->errorResponse(
                $request,
                'An unexpected error occurred.'
            );
        }

        $user->forceFill([
            'password' => bcrypt($validated['password']),
        ])->save();

        DB::table('password_reset_otps')->where('email', $email)->delete();

        if (! $this->wantsJson($request)) {
            $request->session()->forget('otp_verified_email');
        }

        return $this->successResponse(
            $request,
            'Password has been reset successfully.',
            'Login-page'
        );
    }
}
