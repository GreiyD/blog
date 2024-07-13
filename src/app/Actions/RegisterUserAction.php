<?php

namespace App\Actions;

use App\Contracts\RegisterActionContract;
use App\Models\Profile;
use App\Models\User;

class RegisterUserAction implements RegisterActionContract
{
    public function __invoke(array $data): User
    {
        $user = User::create([
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

//        $profile = new Profile();
//        $user->profile()->save($profile);

        return $user;
    }
}
