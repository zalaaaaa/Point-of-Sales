<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'BRG01',
                'barang_nama' => 'Tahu Telor',
                'harga_beli' => 10000,
                'harga_jual' => 12000
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'BRG02',
                'barang_nama' => 'Pecel Ayam',
                'harga_beli' => 12000,
                'harga_jual' => 15000
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'BRG03',
                'barang_nama' => 'Es Teh Jumbo',
                'harga_beli' => 3000,
                'harga_jual' => 4000
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'BRG04',
                'barang_nama' => 'Es Milo',
                'harga_beli' => 4000,
                'harga_jual' => 5000
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'BRG05',
                'barang_nama' => 'Panci',
                'harga_beli' => 15000,
                'harga_jual' => 20000
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'BRG06',
                'barang_nama' => 'Pisau',
                'harga_beli' => 10000,
                'harga_jual' => 13000
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'BRG07',
                'barang_nama' => 'Sampo',
                'harga_beli' => 8000,
                'harga_jual' => 10000
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'BRG08',
                'barang_nama' => 'Pasta Gigi',
                'harga_beli' => 12000,
                'harga_jual' => 14000
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'BRG09',
                'barang_nama' => 'Televisi',
                'harga_beli' => 1000000,
                'harga_jual' => 1200000
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'BRG10',
                'barang_nama' => 'Laptop',
                'harga_beli' => 5000000,
                'harga_jual' => 5100000
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
