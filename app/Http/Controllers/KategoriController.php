<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\m_kategori;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now()
        // ];

        // DB::table('m_kategoris')->insert($data);
        // return 'insert data baru berhasil';

        return $dataTable->render('kategori.index');
    }

    public function create(){
        return view('kategori.create');
    }

    public function store(Request $request){
        m_kategori::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori
        ]);

        return redirect('/kategori');
    }
    public function update($id)
	{
		$kategori = m_kategori::find($id);
		return view('kategori.update', ['data' => $kategori]);
	}

	public function update_simpan($id, Request $request)
	{
		$request->validate([
			'kodeKategori' => 'required',
			'namaKategori' => 'required',
		]);

		$kategori = m_kategori::findOrFail($id);

		$kategori->kategori_kode = $request->kodeKategori;
		$kategori->kategori_nama = $request->namaKategori;

		$kategori->save();
		return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui.');
	}
	public function hapus($id)
	{
		$kategori = m_kategori::find($id);
		$kategori->delete();

		return redirect('/kategori');
	}
}
