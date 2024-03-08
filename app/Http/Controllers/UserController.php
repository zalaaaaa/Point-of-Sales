<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // // mencari user dengan primary key 1
        // $user = UserModel::find(1);
        // return view('user', ['data' => $user]);

        // // mencari user pertama dengan level id 1 menggunakan where
        // $user = UserModel::where('level_id', 1)->first();
        // return view('user', ['data' => $user]);

        // // mencari user pertama dengan level id 1 menggunakan first where
        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        // // mencari menggunakan findOr
        // $user = UserModel::findOr(1, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        // // mencari menggunakan findOr (tidak ditemukan)
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        // // mencari menggunakan findOrFail
        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => $user]);

        // mencari menggunakan findOrFail (tidak ditemukan)
        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user', ['data' => $user]);
    }
}
