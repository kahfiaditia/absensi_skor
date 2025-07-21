<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Kosongkan tabel
            DB::table('kep_jabatan')->truncate();

            // Aktifkan kembali foreign key check
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Data jabatan
        $data = [
            [
                'kode_jabatan'  => 'JBT001',
                'nama_jabatan'  => 'Manajer',
                'keterangan'    => 'Bertanggung jawab penuh atas unit kerja',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'kode_jabatan'  => 'JBT002',
                'nama_jabatan'  => 'Supervisor',
                'keterangan'    => 'Mengawasi operasional harian',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'kode_jabatan'  => 'JBT003',
                'nama_jabatan'  => 'Staff',
                'keterangan'    => 'Melaksanakan tugas teknis',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('kep_jabatan')->insert($data);
    }
}
