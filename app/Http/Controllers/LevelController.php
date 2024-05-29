<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    // public function index()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Daftar Level',
    //         'list' => ['Home', 'Level']
    //     ];

    //     $page = (object) [
    //         'title' => 'Daftar level yang terdaftar dalam sistem',
    //     ];

    //     $activeMenu = 'level'; // Set menu yang sedang aktif 

    //     return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    // }

    // public function list(Request $request)
    // {
    //     $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

    //     return DataTables::of($levels)
    //         ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    //         ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
    //             $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
    //             $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    //         ->make(true);
    // }

    // public function create()
    // {
    //     $breadcrumb = (object) [
    //         'title' => 'Tambah Level',
    //         'list' => ['Home', 'Level', 'Tambah']
    //     ];

    //     $page = (object) [
    //         'title' => 'Tambah level baru',
    //     ];

    //     $activeMenu = 'level'; // Set menu yang sedang aktif

    //     return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
    //         'level_nama' => 'required|string|max:100',
    //     ]);

    //     LevelModel::create([
    //         'level_kode' => $request->level_kode,
    //         'level_nama' => $request->level_nama,
    //     ]);

    //     return redirect('/level')->with('success', 'Data level berhasil disimpan');
    // }

    // public function show(string $id)
    // {
    //     $level = LevelModel::find($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Detail Level',
    //         'list' => ['Home', 'Level', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail level',
    //     ];

    //     $activeMenu = 'level'; // Set menu yang sedang aktif

    //     return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    // }

    // public function edit(string $id)
    // {
    //     $level = LevelModel::find($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Edit Level',
    //         'list' => ['Home', 'Level', 'Edit']
    //     ];

    //     $page = (object) [
    //         'title' => 'Edit level',
    //     ];

    //     $activeMenu = 'level'; // Set menu yang sedang aktif

    //     return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    // }

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
    //         'level_nama' => 'required|string|max:100',
    //     ]);

    //     LevelModel::find($id)->update([
    //         'level_kode' => $request->level_kode,
    //         'level_nama' => $request->level_nama,
    //     ]);

    //     return redirect('/level')->with('success', 'Data level berhasil diubah');
    // }

    // public function destroy(string $id)
    // {
    //     $check = LevelModel::find($id);
    //     if (!$check) {
    //         return redirect('/level')->with('error', 'Data level tidak ditemukan');
    //     }

    //     try {
    //         LevelModel::destroy($id); // Hapus data

    //         return redirect('/level')->with('success', 'Data level berhasil dihapus');
    //     } catch (\Throwable $th) {

    //         // Membawa pesan error jika terdapat error ketika menghapus data
    //         return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }
    public function index(){
        return LevelModel::all();
    }
    public function store(Request $request){
        $level = LevelModel::create($request->all());
        return response()->json($level, 201);
    }
    public function show(LevelModel $level){
        return LevelModel::find($level);
    }
    public function update(Request $request, LevelModel $level){
        $level->update($request->all());
        return LevelModel::find($level);
    }
    public function destroy(LevelModel $level){
        $level->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus'
        ], 204);
    }
}
