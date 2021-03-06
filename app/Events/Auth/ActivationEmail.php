<?php

namespace App\Events\Auth;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ActivationEmail
{
    use Dispatchable, SerializesModels;

    public $user;
    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
