<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\KepDepartemenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KepDepartemenController extends Controller
{

    protected $title = 'Departemen';
    protected $menu = 'Departemen';

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
            'data_departemen' => KepDepartemenModel::whereNull('deleted_at')->get(),
        ];

        return view('kepegawaian.departemen.index')->with($data);
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

        return view('kepegawaian.departemen.tambah')->with($data);
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
        $validator = Validator::make($request->all(), [
            'kode_departemen'   => 'required|string|max:20|unique:departemen,kode_departemen',
            'nama_departemen'   => 'required|string|max:50',
            'keterangan'        => 'nullable|string',
        ]);

    DB::beginTransaction();
    try {
        

        $data = new KepDepartemenModel();
        $data->kode_departemen   = $request->kode_departemen;
        $data->nama_departemen   = $request->nama_departemen;
        $data->keterangan        = $request->keterangan;
        $data->save();

        DB::commit();
            AlertHelper::addAlert(true);
            return redirect('departemen');
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
