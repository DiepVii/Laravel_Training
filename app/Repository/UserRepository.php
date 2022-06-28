<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function create($attributes)
    {
        return User::create($attributes);
    }
    public function get_all_employee()
    {
        return User::where('role', 1)->get();
    }
}
