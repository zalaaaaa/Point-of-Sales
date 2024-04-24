<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\m_level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LevelController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        // $user = m_level::all();
        // return view('user', ['data' => $user]);

        return $dataTable->render('level.index');
    }

    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request)
    {
        m_level::create([
            'level_id' => $request->level_id,
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/user');
    }

    public function update($id)
    {
        $level = m_level::find($id);
        return view('level.update', ['data' => $level]);
    }

    public function update_simpan($id, Request $request)
    {
        $user = m_level::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request->password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id)
    {
        $user = m_level::find($id);
        $user->delete();
        return redirect('/user');
    }
}
