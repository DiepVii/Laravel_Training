<?php

namespace App\Services;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function random()
    {
        $rand = '';
        for ($x = 0; $x < 5; $x++) {
            $rand .= rand(0, 9999);
        }
        return $rand;
    }
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create_user(Request $request)
    {
        $validate = $request->validate([
            'name'             => 'required|string|regex:/^[a-zA-Z\-\s]+$/',                        // just a normal required validation
            'email'            => 'required|email|unique:Users',     // required and must be unique in the ducks table
            'password'         => 'required|min:6|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'confirm_password' => 'required|same:password',
            'image' => 'mimes:webp,jpeg,jpg,png,gif|max:10000'
        ]);

        $file = $request->file('image');
        $path = public_path('/backend/images/user');
        $file_name = $this->random() . $file->getClientOriginalName();
        $file->move($path, $file_name);
        $file_path = ('backend/images/user/')  . $file_name;

        $attribute = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $file_path,
            'password' => Hash::make($request->password)
        ];
        $user = $this->userRepository->create($attribute);

        return $user;
    }

    public function get_employee()
    {
        $employee = $this->userRepository->get_all_employee();
        return $employee;
    }
}
