<?php

namespace App\Services;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private $userObj;

    public function __construct(User $userObj)
    {
        $this->userObj = $userObj;
    }

    public function login($inputs)
    {
        $credentials = Arr::only($inputs, ['email', 'password']);
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'password' => ['Invalid password!'],
            ]);
        } else {
            $user = Auth::user();
            $token = $user->createToken(config('app.name'))->plainTextToken;
        }

        $data = [
            'user' => isset($user) ? $user : '',
            'token' => $token,
        ];

        return $data;
    }

}