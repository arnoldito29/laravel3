<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param User $user
     * @param array $requestData
     * @return bool
     */
    public function update(User $user, array $requestData): bool
    {
        if (!empty($requestData['name'])) {
            $user->name = $requestData['name'];
        }

        if (!empty($requestData['surname'])) {
            $user->surname = $requestData['surname'];
        }

        if (!empty($requestData['email'])) {
            $user->email = $requestData['email'];
        }

        if (!empty($requestData['avatar'])) {
            $user->avatar = $requestData['avatar'];
        }

        if (!empty($requestData['password'])) {
            $user->password = Hash::make($requestData['password']);
        }

        return $user->save();
    }
}
