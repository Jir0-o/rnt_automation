<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userEmail = $request->email;

        // Check if the email is matched with the user email in the database
        $user = User::where('email', $userEmail)->first();

        if ($user) {
            // Generate a valid token (use a better random generator if needed)
            $validToken = rand(100000, 999999);  

            // Delete any existing password reset token for the user
            PasswordResetToken::where('email', $user->email)->delete();
            
            // Save the token in the password_resets table
            $get_token = new PasswordResetToken();
            $get_token->token = $validToken;
            $get_token->email = $user->email;
            $get_token->save();

            // Send email to the user
            try {
                Mail::to($user->email)->send(new ForgotPassword($user->email, $validToken, $user->name));

                // If the mail is sent, redirect to OTP verification page
                return redirect()->route('otp-verification-page')->with('success', 'A verification code has been sent to your email.');
            } catch (\Exception $e) {
                // Handle the case where the email could not be sent
                return redirect()->back()->with('error', 'Failed to send email. Please try again.');
            }

        } else {
            // If no user is found with that email
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function otpVerificationPage()
    {
        return view('auth.otp-verification');
    }

    public function resetPasswordPage(Request $request)
    {
        // Ensure token and email are passed to the view
        return view('auth.reset-password', [
            'token' => $request->token,
            'email' => $request->email
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function otpVerification(Request $request)
    {

        $get_email = PasswordResetToken::where('token', $request->verifyToken)->first();
        
        // dd($get_email);

        // Retrieve the user by their email
        if(!$get_email){
            return redirect()->back()->with('error', 'Invalid Token.');
        }

        $user = User::where('email', $get_email->email)->first();

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid Token.');
        }

        // Check if the token is valid for the user's email
        $passwordReset = PasswordResetToken::where('email', $get_email->email)
                                        ->where('token', $request->verifyToken)
                                        ->first();

        if ($passwordReset) {
            // Token is valid, proceed with password reset or verification success
            // Redirect to the password reset page with the token and email
            return redirect()->route('reset-password-page', [
                'token' => $request->verifyToken,
                'email' => $get_email->email
            ])->with('success', 'OTP verified successfully. You may now reset your password.');            

        } else {
            // Token is invalid or expired
            return redirect()->back()->with('error', 'Invalid or expired verification code.');
        }
    }

    public function resetPassword(Request $request)
    {
        // Validate the incoming request to ensure the password is provided
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        // Retrieve the user by their email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid email address.');
        }

        // Update the user's password
        $user->password = bcrypt($request->password);
        $user->save();

        // Delete the password reset token
        PasswordResetToken::where('email', $request->email)->delete();

        // Redirect the user to the login page
        return redirect()->route('login')->with('success', 'Password reset successfully. You may now login with your new password.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
