<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $barangIds = DB::table('m_barangs')->pluck('barang_id')->all();
        $userIds = DB::table('m_users')->pluck('user_id')->all();
        $currentDate = Carbon::now();

        foreach ($barangIds as $barangId) {
            // Setiap barang memiliki entri stok dengan jumlah random untuk tanggal yang berbeda-beda
            for ($i = 0; $i < 2; $i++) {
                $stokTanggal = $currentDate->copy()->subDays(rand(1, 30));
                $data[] = [
                    'barang_id' => $barangId,
                    'user_id' => $userIds[array_rand($userIds)], // Menggunakan array_rand untuk mengambil user id secara acak
                    'stok_tanggal' => $stokTanggal,
                    'stok_jumlah' => rand(0, 50), // Stok jumlah diacak 0-50
                ];
            }
        }

        DB::table('t_stoks')->insert($data);
    }
}
