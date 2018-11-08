<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param Builder $queryBuilder
     * @param $email
     * @param $token
     * @return $this
     */
    public function scopeByActivationColumns(Builder $queryBuilder, $email, $token)
    {
        return $queryBuilder->where('email', $email)->where('activation_token', $token);
    }

    /**
     * @param Builder $builder
     * @param $email
     * @return $this
     */
    public function scopeByEmail(Builder $builder, $email)
    {
        return $builder->where('email', $email);
    }
}
