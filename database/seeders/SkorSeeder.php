<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('kep_skor')->truncate();

        // 2) Data referensi skor kehadiran
        $data = [
            [
                'status_kehadiran' => 'Tepat Waktu',
                'keterangan'       => 'Bagus',
                'skor'             => 100,
            ],
            [
                'status_kehadiran' => 'Telat Ringan',
                'keterangan'       => 'Terlambat ≤ 15 menit dari jam_masuk',
                'skor'             => 80,
            ],
            [
                'status_kehadiran' => 'Telat Sedang',
                'keterangan'       => 'Terlambat > 15 menit dan ≤ 30 menit',
                'skor'             => 60,
            ],
            [
                'status_kehadiran' => 'Telat Berat',
                'keterangan'       => 'Terlambat > 30 menit dan ≤ 60 menit',
                'skor'             => 40,
            ],
            [
                'status_kehadiran' => 'Terlambat Parah',
                'keterangan'       => 'Terlambat > 60 menit',
                'skor'             => 20,
            ],
            [
                'status_kehadiran' => 'Tidak Hadir (tanpa izin)',
                'keterangan'       => 'Tidak absen sama sekali',
                'skor'             => 0,
            ],
        ];

        // 3) Masukkan data baru
        DB::table('kep_skor')->insert($data);
    }
}
