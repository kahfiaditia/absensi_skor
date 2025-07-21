<?php

namespace App\Http\Controllers;

use App\Models\KepAbsensiModel;
use App\Models\KepSettingModel;
use App\Models\KepSkorModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepAbsenController extends Controller
{
    protected $title = 'Absensi';
    protected $menu = 'Absensi';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    public function scanBarcode1(Request $request)
    {
        $result = DB::table('users')
            ->select('id as id_pegawai', 'nip', 'name as nama_pegawai', 'id_departemen as departemen', 'id_jabatan as jabatan')
            ->where('roles', 'pegawai')
            ->get();

        if (count($result) > 0) {
            return response()->json([
                'code' => 200,
                'data' => $result,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }

    public function pilih_pegawai(Request $request)
    {
        $result = DB::table('users')
            ->select('id as id_pegawai', 'nip', 'name as nama_pegawai', 'id_departemen as departemen', 'id_jabatan as jabatan')
            ->where('roles', 'pegawai')
            ->get();

        if (count($result) > 0) {
            return response()->json([
                'code' => 200,
                'data' => $result,
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => null,
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Absensi',
            'jam_masuk' => KepSettingModel::first(),
           
        ];
        return view('kepegawaian.absensi.absensi')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $absensiData = [];
            
    //         foreach ($request->absensi as $absen) {
    //             $parts = explode(', ', $absen['waktu_absen']);
    //             $hari = $parts[0];
    //             $jamAbsen = $parts[1];

    //             $telat = (int) $absen['keterlambatan'];
    //             $skor = KepSkorModel::when($telat <= 0, fn($q) => $q->where('id', 1))
    //                 ->when($telat > 0 && $telat <= 15, fn($q) => $q->orWhere('id', 2))
    //                 ->when($telat > 15 && $telat <= 30, fn($q) => $q->orWhere('id', 3))
    //                 ->when($telat > 30 && $telat <= 60, fn($q) => $q->orWhere('id', 4))
    //                 ->when($telat > 60, fn($q) => $q->orWhere('id', 5))
    //                 ->first();

    //             $absensi = KepAbsensiModel::create([
    //                 'id_pegawai'      => $absen['id_pegawai'],
    //                 'nip'             => $absen['nip'],
    //                 'nama'            => $absen['nama'],
    //                 'jam_masuk'       => $absen['jam_masuk'],
    //                 'jam_pulang'      => null,
    //                 'hari_absen'      => $hari,
    //                 'absen_karyawan'  => $jamAbsen,
    //                 'keterlambatan'   => $telat,
    //                 'id_skor'         => $skor?->id_status_kehadiran,
    //                 'skor'            => $skor?->skor ?? 0,
    //                 'keterangan'      => $absen['status'],
    //             ]);

    //             $absensiData[] = $absensi;
    //         }

    //         DB::commit();
            
    //         // Return JSON response for AJAX
    //         return response()->json([
    //             'code' => 200,
    //             'message' => 'Data absensi berhasil disimpan.',
    //             'data' => $absensiData
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json([
    //             'code' => 500,
    //             'message' => 'Gagal menyimpan data absensi: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $absensiData = [];
            
            foreach ($request->absensi as $absen) {
                $parts = explode(', ', $absen['waktu_absen']);
                $hari = $parts[0];
                $jamAbsen = str_replace('.', ':', $parts[1]); // Convert dots to colons

                $telat = (int) $absen['keterlambatan'];
                $skor = KepSkorModel::when($telat <= 0, fn($q) => $q->where('id', 1))
                    ->when($telat > 0 && $telat <= 15, fn($q) => $q->orWhere('id', 2))
                    ->when($telat > 15 && $telat <= 30, fn($q) => $q->orWhere('id', 3))
                    ->when($telat > 30 && $telat <= 60, fn($q) => $q->orWhere('id', 4))
                    ->when($telat > 60, fn($q) => $q->orWhere('id', 5))
                    ->first();

                $absensi = KepAbsensiModel::create([
                    'id_pegawai'      => $absen['id_pegawai'],
                    'nip'             => $absen['nip'],
                    'nama'            => $absen['nama'],
                    'jam_masuk'       => $absen['jam_masuk'],
                    'jam_pulang'      => null,
                    'hari_absen'      => $hari,
                    'absen_karyawan'  => $jamAbsen, // Now in HH:MM:SS format
                    'keterlambatan'   => $telat,
                    'id_skor'         => $skor?->id,
                    'skor'            => $skor?->skor ?? 0,
                    'keterangan'      => $absen['status'],
                ]);

                $absensiData[] = $absensi;
            }

            DB::commit();
            
            return response()->json([
                'code' => 200,
                'message' => 'Data absensi berhasil disimpan.',
                'data' => $absensiData
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'code' => 500,
                'message' => 'Gagal menyimpan data absensi: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
