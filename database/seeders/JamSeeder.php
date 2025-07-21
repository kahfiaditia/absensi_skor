<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Nonaktifkan foreign key checks (khusus untuk MySQL)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Kosongkan tabel kep_setting
        DB::table('kep_setting')->truncate();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Isi data baru
        DB::table('kep_setting')->insert([
            [
                'id_hari'    => 1, // Senin
                'jam_masuk'  => '07:30:00',
                'jam_pulang' => '16:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_hari'    => 2, // Selasa
                'jam_masuk'  => '08:00:00',
                'jam_pulang' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_hari'    => 3, // Rabu
                'jam_masuk'  => '08:00:00',
                'jam_pulang' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_hari'    => 4, // Kamis
                'jam_masuk'  => '08:00:00',
                'jam_pulang' => '17:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_hari'    => 5, // Jumat
                'jam_masuk'  => '07:30:00',
                'jam_pulang' => '16:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
