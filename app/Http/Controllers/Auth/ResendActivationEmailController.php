<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\ActivationEmail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResendActivationEmailController extends Controller
{
    public function showResendForm()
    {
        return view('auth.activation.resend');
    }

    public function resend(Request $request)
    {
        $this->validateRequest($request);

        $user = User::byEmail($request->email)->first();
        
        event(new ActivationEmail($user));

        return redirect()->route('login')
            ->withSuccess('Account activation email has been resent.');
    }

    protected function validateRequest(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Could not find an account with that email address.'
        ]);
    }
}
