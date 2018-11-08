<?php

namespace App\Http\Controllers\Auth;

use App\User;
use http\Exception;
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
        try {
            $user = User::byActivationColumns($request->email, $request->token)->firstOrFail();
        } catch (Exception $e) {
            return abort(404);
        }

        $user->update([
            'is_active' => true,
            'activation_token' => null
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('home')->withSuccess('Activated account successfully! You\'re now signd in');
    }
}
