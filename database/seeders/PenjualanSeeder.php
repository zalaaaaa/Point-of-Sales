<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $userIds = DB::table('m_users')->pluck('user_id')->all();
        $currentDate = Carbon::now();
        $namaAsli = ['John Doe', 'Jane Smith', 'Michael Johnson', 'Emily Brown', 'David Martinez', 'Sarah Wilson', 'Robert Taylor', 'Karen Anderson', 'Daniel Clark', 'Lisa Thomas'];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'user_id' => $userIds[array_rand($userIds)], // Menggunakan array_rand untuk mengambil user id secara acak
                'pembeli' => $namaAsli[array_rand($namaAsli)], // Menggunakan array_rand untuk mengambil nama asli secara acak
                'penjualan_kode' => 'PJN' . str_pad($i + 1, 3, '0', STR_PAD_LEFT), // Kode penjualan dengan format PJN001, PJN002, dst.
                'penjualan_tanggal' => $currentDate->copy()->subDays(rand(1, 30)), // Menggunakan tanggal acak dalam 30 hari terakhir
            ];
        }

        DB::table('t_penjualans')->insert($data);
    }
}
