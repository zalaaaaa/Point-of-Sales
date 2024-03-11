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
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Laptop', 'harga_beli' => 8000000, 'harga_jual' => 10000000],
            ['barang_id' => 2, 'kategori_id' => 2, 'barang_kode' => 'BRG002', 'barang_nama' => 'Smartphone', 'harga_beli' => 5000000, 'harga_jual' => 7000000],
            ['barang_id' => 3, 'kategori_id' => 1, 'barang_kode' => 'BRG003', 'barang_nama' => 'Printer', 'harga_beli' => 2000000, 'harga_jual' => 3000000],
            ['barang_id' => 4, 'kategori_id' => 3, 'barang_kode' => 'BRG004', 'barang_nama' => 'Mouse', 'harga_beli' => 500000, 'harga_jual' => 800000],
            ['barang_id' => 5, 'kategori_id' => 2, 'barang_kode' => 'BRG005', 'barang_nama' => 'Keyboard', 'harga_beli' => 600000, 'harga_jual' => 900000],
            ['barang_id' => 6, 'kategori_id' => 4, 'barang_kode' => 'BRG006', 'barang_nama' => 'Action Figure', 'harga_beli' => 300000, 'harga_jual' => 500000],
            ['barang_id' => 7, 'kategori_id' => 5, 'barang_kode' => 'BRG007', 'barang_nama' => 'Ballpoint', 'harga_beli' => 5000, 'harga_jual' => 10000],
            ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => 'BRG008', 'barang_nama' => 'Headset', 'harga_beli' => 200000, 'harga_jual' => 300000],
            ['barang_id' => 9, 'kategori_id' => 1, 'barang_kode' => 'BRG009', 'barang_nama' => 'Monitor', 'harga_beli' => 1500000, 'harga_jual' => 2000000],
            ['barang_id' => 10, 'kategori_id' => 4, 'barang_kode' => 'BRG010', 'barang_nama' => 'Board Game', 'harga_beli' => 1000000, 'harga_jual' => 1500000],
        ];
        DB::table('m_barangs')->insert($data);
    }
}
