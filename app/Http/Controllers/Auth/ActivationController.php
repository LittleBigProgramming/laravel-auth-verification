<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function activate(Request $request)
    {
        $user = User::where('email', $request->email)->where('activation_token', $request->token)->firstOrFail();

        $user->update([
            'is_active' => true,
            'activation_token' => null
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('home')->withSuccess('Activated account successfully! You\'re now signd in');
    }
}
