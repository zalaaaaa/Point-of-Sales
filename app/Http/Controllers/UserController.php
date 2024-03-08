<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // tambah data user dengan Eloquent Model
        $data = [
            'username' => 'Manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ];
        UserModel::create($data); // tambah data ke tabel m_user

        $user = UserModel::all(); // ambil semua data dari tabel m_user
        return view('user', ['data' => $user]);

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data); // update data user

        // // coba akses model UserModel
        // $user = UserModel::all(); // ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);
    }
}
