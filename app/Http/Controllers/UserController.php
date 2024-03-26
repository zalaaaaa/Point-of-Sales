<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function index()
    // {
    //     // get all user with level
    //     $user = UserModel::with('level')->get();
    //     return view('user.create', ['data' => $user]);
    // }

    // public function store(Request $request): RedirectResponse
    // {
    //     $validator = $request->validate([
    //         'nama' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',
    //         'level_id' => 'required',
    //     ]);

    //     UserModel::create([
    //         'nama' => $request->nama,
    //         'username' => $request->username,
    //         'password' => $request->password,
    //         'level_id' => $request->level_id,
    //     ]);
    //     return redirect('/user');
    // }

    // // public function index()
    // // {
    // //     // get all user
    // //     $user = UserModel::all();
    // //     return view('user', ['data' => $user]);
    // // }

    // public function tambah()
    // {
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request)
    // {
    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => Hash::make('$request->password'),
    //         'level_id' => $request->level_id,
    //     ]);

    //     return redirect('/user');
    // }

    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }

    // public function hapus($id)
    // {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

    public function index(Request $request)
    {
        $users = DB::table('m_user')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('nama', 'like', '%' . $name . '%');
            })
            ->orderBy('user_id', 'desc')
            ->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level_id' => 'required',
        ]);

        $user = new UserModel();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->level_id = $request->level_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = UserModel::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'level_id' => 'required',
        ]);

        $user = UserModel::find($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->level_id = $request->level_id;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = UserModel::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
