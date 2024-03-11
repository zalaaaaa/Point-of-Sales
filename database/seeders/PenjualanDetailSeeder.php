<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $barangIds = DB::table('m_barangs')->pluck('barang_id')->all(); // Mengasumsikan 10 barang tersedia
        $currentDate = Carbon::now();

        // Iterasi sebanyak 10 kali (sama dengan jumlah transaksi penjualan)
        for ($i = 1; $i <= 10; $i++) {
            // Setiap transaksi penjualan memiliki 3 barang yang dibeli
            for ($j = 1; $j <= 3; $j++) {
                $data[] = [
                    'penjualan_id' => $i, // ID transaksi penjualan
                    'barang_id' => $barangIds[array_rand($barangIds)], // Barang diambil secara acak
                    'harga' => rand(10, 50) * 1000, // Harga barang acak antara 1000 dan 5000
                    'harga_jumlah' => rand(1, 5), // Jumlah barang acak antara 1 dan 5
                ];
            }
        }

        DB::table('t_penjualan_details')->insert($data);
    }
}
