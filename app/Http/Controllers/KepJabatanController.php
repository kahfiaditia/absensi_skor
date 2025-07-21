<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\KepJabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KepJabatanController extends Controller
{
    protected $title = 'Jabatan';
    protected $menu = 'Jabatan';
    
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
            'data_jabatan' => KepJabatanModel::whereNull('deleted_at')->get(),
        ];

        return view('kepegawaian.jabatan.index')->with($data);
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
        ];

        return view('kepegawaian.jabatan.tambah')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'kode_jabatan' => 'required|string|max:50|unique:kep_jabatan,kode_jabatan',
        'nama_jabatan' => 'nullable|string|max:50',
        'keterangan' => 'nullable|string|max:50',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    DB::beginTransaction();
    try {
        
        $data = new KepJabatanModel();
        $data->kode_jabatan = $request->kode_jabatan;
        $data->nama_jabatan = $request->nama_jabatan;
        $data->keterangan = $request->keterangan;
        $data->save();

        DB::commit();
            AlertHelper::addAlert(true);
            return redirect('jabatan_data');
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
