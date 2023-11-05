<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\ModelHelper;
use Exception;

class UserAuthService
{
    use ModelHelper;

    public function login($validatedData)
    {
        $user = User::where('email', $validatedData['email'])->first();
        if (!$user) {
            throw new Exception(__('messages.credentialsError'), 401);
        }

        $attemptedData = [
            'email'    => $user->email,
            'password' => $validatedData['password']
        ];

        if (!$token = Auth::guard('user')->attempt($attemptedData)) {
            throw new Exception(__('messages.incorrect_password'), 401);
        }
        return [
            'token' => $token
        ];
    }

    public function changePassword($validatedData)
    {
        /**
         * @var $user=App\Models\Employee
         */
        $user = Auth::guard('user')->user();

        DB::beginTransaction();

        $user->update(['password' => Hash::make($validatedData['new_password'])]);

        DB::commit();
    }

    public function logout()
    {
        Auth::guard('user')->logout();
    }
}
