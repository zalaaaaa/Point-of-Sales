<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function indexApi(){
        return UserModel::all();
    }
    public function storeApi(Request $request){
        $user = UserModel::create($request->all());
        return response()->json($user, 201);
    }
    public function showApi(UserModel $user){
        return UserModel::find($user);
    }
    public function updateApi(Request $request, UserModel $user){
        $user->update($request->all());
        return UserModel::find($user);
    }
    public function destroyApi(UserModel $user){
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus'
        ], 204);
    }

    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem',
        ];

        $activeMenu = 'user'; // Set menu yang sedang aktif

        $level = LevelModel::all(); // Ambil data level untuk filter level

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        // Filter data user berdasarkan level_id
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru',
        ];

        $level = LevelModel::all(); // Ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // Set menu yang sedang aktif

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    // Menampilkan detail user
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user',
        ];

        $activeMenu = 'user'; // Set menu yang sedang aktif

        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user',
        ];

        $activeMenu = 'user'; // Set menu yang sedang aktif

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    // Menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id); // Hapus data

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Throwable $th) {

            // Membawa pesan error jika terdapat error ketika menghapus data
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }


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

    // public function index(Request $request)
    // {
    //     $users = DB::table('m_user')
    //         ->when($request->input('name'), function ($query, $name) {
    //             return $query->where('nama', 'like', '%' . $name . '%');
    //         })
    //         ->orderBy('user_id', 'desc')
    //         ->paginate(10);
    //     return view('users.index', compact('users'));
    // }

    // public function create()
    // {
    //     return view('users.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',
    //         'level_id' => 'required',
    //     ]);

    //     $user = new UserModel();
    //     $user->nama = $request->nama;
    //     $user->username = $request->username;
    //     $user->level_id = $request->level_id;
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'User created successfully.');
    // }

    // public function show($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('users.show', compact('user'));
    // }

    // public function edit($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('users.edit', compact('user'));
    // }

    // public function update($id, Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required',
    //         'username' => 'required',
    //         'level_id' => 'required',
    //     ]);

    //     $user = UserModel::find($id);
    //     $user->nama = $request->nama;
    //     $user->username = $request->username;
    //     $user->level_id = $request->level_id;
    //     if ($request->password) {
    //         $user->password = Hash::make($request->password);
    //     }
    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'User updated successfully.');
    // }

    // public function destroy($id)
    // {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    // }
}
