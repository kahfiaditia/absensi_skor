<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Matikan foreign key check
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Kosongkan tabel
            DB::table('kep_departemen')->truncate();

            // Aktifkan kembali foreign key check
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Data departemen
        $data = [
            [
                'kode_departemen'  => 'D001',
                'nama_departemen'  => 'HRD',
                'keterangan'        => 'Departemen Sumber Daya Manusia',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_departemen'  => 'D002',
                'nama_departemen'  => 'Keuangan',
                'keterangan'        => 'Departemen Pengelolaan Keuangan',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_departemen'  => 'D003',
                'nama_departemen'  => 'Operasional',
                'keterangan'        => 'Departemen Pelaksana Kegiatan Operasional',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_departemen'  => 'D004',
                'nama_departemen'  => 'Teknologi Informasi',
                'keterangan'        => 'Departemen Pelaksana Kegiatan Operasional',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ];

        DB::table('kep_departemen')->insert($data);
    }
}
