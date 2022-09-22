<?php

namespace App\Services;

use App\Exceptions\UnAuthorizedException;
use App\Models\User;

/**
 * Class AuthService
 */
class AuthService
{
    /**
     * Login action
     *
     * @param  array  $payload
     * @return array
     */
    public function login(array $payload)
    {
        if (! $token = auth()->attempt($payload)) {
            throw new UnAuthorizedException('Wrong email/password combination');
        }

        return [
            'access_token' => $token,
            'user' => auth()->user(),

        ];
    }

    /**
     * Register action
     *
     * @param  array  $payload
     * @return array
     */
    public function register(array $payload)
    {
        $payload['password'] = bcrypt($payload['password']);

        return User::create($payload)->toArray();
    }

    /**
     * invalidate user session
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
    }
}
