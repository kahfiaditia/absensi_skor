<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\KepDepartemenModel;
use App\Models\KepJabatanModel;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;

class KepPegawaiController extends Controller
{
    protected $title = 'Pegawai';
    protected $menu = 'Pegawai';
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
            'data_pegawai' => User::where('roles', 'Pegawai')->get(),
        ];

        return view('kepegawaian.pegawai.index')->with($data);
    }

     public function cetak_barcode()
    {
       $pegawai = User::whereNotNull('nip')->get();

        // Generate barcode PNG Base64
        $barcode = new DNS1D();
        $barcode->setStorPath(storage_path('framework/laravel-barcode/'));

        foreach ($pegawai as $p) {
            $p->barcode_base64 = $barcode->getBarcodePNG($p->nip ?? '00000000', 'C128');
        }

        $pdf = Pdf::loadView('kepegawaian.pegawai.cetak_barcode', compact('pegawai'));
        return $pdf->download('barcode_pegawai.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'data_jabatan' => KepJabatanModel::whereNull('deleted_at')->get(),
            'data_departemen' => KepDepartemenModel::whereNull('deleted_at')->get(),
        ];
        return view('kepegawaian.pegawai.tambah')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

            $validated = $request->validate([
                'nip'            => 'required|string|max:20|unique:users,nip',
                'name'           => 'required|string|max:50',
                'email'          => 'required|email|unique:users,email',
                'id_departemen'  => 'required|exists:kep_departemen,id',
                'id_jabatan'     => 'required|exists:kep_jabatan,id',
                'phone'          => 'required|string|max:20',
            ]);

            DB::beginTransaction();
            try {
                $data = new User();
                $data->name = $request->name;
                $data->nip = $request->nip;
                $data->id_jabatan = $request->id_jabatan;
                $data->id_departemen = $request->id_departemen;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->address = $request->address;
                $data->password = bcrypt('12345');
                $data->roles = $request->flag; // atau random string
                $data->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('pegawai_data');
            } catch (\Throwable $err) {
                DB::rollback();
                AlertHelper::addAlert(false);
                return back()->withErrors(['error' => 'Gagal menyimpan data pegawai.']);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'edit_pegawai' => User::whereNull('deleted_at')->get(),
        ];
        return view('kepegawaian.pegawai.edit')->with($data);
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
