<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // DB::insert('insert into  m_levels(level_kode, level_nama, created_at) values (?,?,?)', ['CUS', 'Pelanggan', now()]);

        // return 'insert data baru berhasil';

        // $row = DB::delete('delete from m_levels where level_kode = ?', ['CUS']);

        // return 'Delete data berhasil. Jumlah data yang dihapus ' . $row . 'baris';

        $data = DB::select('select * from m_levels');
        return view('level', ['data'=> $data]);
    }
}
