<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\HariModel;
use App\Models\JadwalKegiatanModel;
use App\Models\KepSettingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KepSettingController extends Controller
{
    protected $title = 'Jam Kerja';
    protected $menu = 'Jam Kerja';
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
            'label' => $this->menu,
            'data_jam' => KepSettingModel::whereNull('deleted_at')->get(),
        ];

        return view('kepegawaian.setting.setting')->with($data);
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
            'label' => $this->menu,
            
            // 'pembina' => User::where('roles', 'pembina')->get(),

        ];
       return view('kepegawaian.setting.tambah')->with($data);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validasi input
        $validator = Validator::make($request->all(), [
            'jam_masuk' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i|after:jam_masuk',
        ]);

        DB::beginTransaction();
        try {
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                // Simpan data ke database
                $data = new KepSettingModel();
                $data->jam_masuk = $request->jam_masuk;
                $data->jam_pulang = $request->jam_pulang;
                $data->save();

        
            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('setting_data');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }

      
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalKegiatanModel  $JadwalKegiatanModel
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalKegiatanModel  $JadwalKegiatanModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataedit = DB::table('table_jadwal_hari')
            ->select('table_jadwal_hari.*', 'users.name as nama_pembina', 'ekstrakurikuler.name as nama_kegiatan', 'table_hari.nama_hari')
            ->join('users', 'table_jadwal_hari.id_pembina', '=', 'users.id')
            ->join('ekstrakurikuler', 'table_jadwal_hari.id_kegiatan', '=', 'ekstrakurikuler.id')
            ->join('table_hari', 'table_jadwal_hari.id_hari', '=', 'table_hari.id')
            ->where('table_jadwal_hari.id', $id)
            ->first();

        // dd($dataedit);

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'data' => 'Edit Jadwal',
            'jadwal' => $dataedit,
            'nama_harinya' => HariModel::all(),
        ];
        return view('jadwal.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JadwalKegiatanModel  $JadwalKegiatanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        DB::beginTransaction();
        try {
            // dd($request->hari);

            $jadwal = JadwalKegiatanModel::findOrFail($id);
            $jadwal->id_pembina = $request->pembina;
            $jadwal->id_kegiatan = $request->kegiatan;
            $jadwal->id_hari = $request->hari;
            $jadwal->jam_mulai = $request->mulai;
            $jadwal->jam_selesai = $request->selesai;
            $jadwal->status = $request->status1;
            $jadwal->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('/jadwal');
        } catch (\Throwable $err) {
            DB::rollback();
            throw $err;
            AlertHelper::addAlert(false);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalExtraModel  $jadwalExtraModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $hapus = JadwalKegiatanModel::findorfail($id);
            $hapus->user_deleted = Auth::user()->id;
            $hapus->deleted_at = Carbon::now();
            $hapus->save();

            DB::commit();
            AlertHelper::deleteAlert(true);
            return back();
        } catch (\Throwable $err) {
            DB::rollBack();
            AlertHelper::deleteAlert(false);
            return back();
        }
    }
}
