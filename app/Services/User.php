<?php 
namespace App\Services;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class User {

    public function store($data) {
        $user = UserModel::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
         ]);

        return $user;
    }

}