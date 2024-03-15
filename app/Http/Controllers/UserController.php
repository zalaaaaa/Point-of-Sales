<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // return view('user.profile')
        // ->with('id', $id)
        // ->with('name', $name);

        $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345')
        ];

        UserModel::create($data);

        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}
