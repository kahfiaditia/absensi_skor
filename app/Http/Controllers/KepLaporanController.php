<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\KepAbsensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class KepLaporanController extends Controller
{
    protected $title = 'Laporan Absensi';
    protected $menu = 'Laporan';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => 'Absensi',
            'laporan' => KepAbsensiModel::whereNotNull('deleted_at')->get(),
           
        ];
        return view('kepegawaian.laporan.index')->with($data);
    }

     public function get_data_laporan(Request $request)
    {
        $userdata = DB::table('kep_absensi')
            ->whereNull('kep_absensi.deleted_at')
            ->orderBy('kep_absensi.id', 'DESC');

        if ($request->get('search_manual') != null) {
            $search = $request->get('search_manual');
            // $search_rak = str_replace(' ', '', $search);
            $userdata->where(function ($where) use ($search) {
                $where
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('jam_masuk', 'like', '%' . $search . '%')
                    ->orWhere('hari_absen', 'like', '%' . $search . '%')
                    ->orWhere('absen_karyawan', 'like', '%' . $search . '%')
                    ->orWhere('keterlambatan', 'like', '%' . $search . '%')
                    ->orWhere('skor', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%');
                // ->orWhere('id_supplier', 'like', '%' . $search . '%');
            });

            $search = $request->get('search');
            // $search_rak = str_replace(' ', '', $search);
            if ($search != null) {
                $userdata->where(function ($where) use ($search) {
                    $where
                        ->orWhere('nip', 'like', '%' . $search . '%')
                        ->orWhere('nama', 'like', '%' . $search . '%')
                        ->orWhere('jam_masuk', 'like', '%' . $search . '%')
                        ->orWhere('hari_absen', 'like', '%' . $search . '%')
                        ->orWhere('absen_karyawan', 'like', '%' . $search . '%')
                        ->orWhere('keterlambatan', 'like', '%' . $search . '%')
                        ->orWhere('skor', 'like', '%' . $search . '%')
                        ->orWhere('keterangan', 'like', '%' . $search . '%');
                    // ->orWhere('id_supplier', 'like', '%' . $search . '%');
                });
            }
        } else {
            if ($request->get('nip') != null) {
                $nip = $request->get('nip');
                $userdata->where('nip', '=', $nip);
            }
            if ($request->get('nama') != null) {
                $nama = $request->get('nama');
                $userdata->where('nama', '=', $nama);
            }
            if ($request->get('jam_masuk') != null) {
                $jam_masuk = $request->get('jam_masuk');
                $userdata->where('jam_masuk', '=', $jam_masuk);
            }
            if ($request->get('hari_absen') != null) {
                $hari_absen = $request->get('hari_absen');
                $userdata->where('hari_absen', '=', $hari_absen);
            }
            if ($request->get('absen_karyawan') != null) {
                $absen_karyawan = $request->get('absen_karyawan');
                $userdata->where('absen_karyawan', '=', $absen_karyawan);
            }
            if ($request->get('keterlambatan') != null) {
                $keterlambatan = $request->get('keterlambatan');
                $userdata->where('keterlambatan', '=', $keterlambatan);
            }
            if ($request->get('skor') != null) {
                $skor = $request->get('skor');
                $userdata->where('skor', '=', $skor);
            }
            if ($request->get('keterangan') != null) {
                $keterangan = $request->get('keterangan');
                $userdata->where('keterangan', '=', $keterangan);
            }
            if ($request->get('tgl_start') != null && $request->get('tgl_end') != null) {
                $startDate = date('Y-m-d', strtotime($request->get('tgl_start')));
                $endDate = date('Y-m-d', strtotime($request->get('tgl_end')));
                $userdata->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);
            }
        }

        return DataTables::of($userdata)
            ->addColumn('action', 'user.administrator.aksiall')
            ->rawColumns(['action'])
            ->make(true);
    }

    public function export_data(Request $request)
    {
        $data = [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'hari' => $request->hari,
            'skor' => $request->skor,
            'tgl_start' => $request->tgl_start,
            'tgl_end' => $request->tgl_end,
            'type' => $request->type,
            'search_manual' => $request->search_manual,
            'like' => $request->like,
        ];
        return Excel::download(new AbsensiExport($data), 'absensi_' . date('YmdH') . '.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
