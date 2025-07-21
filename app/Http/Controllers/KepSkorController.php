<?php

namespace App\Http\Controllers;

use App\Helper\AlertHelper;
use App\Models\KepSkorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KepSkorController extends Controller
{
    protected $title = 'Skor';
    protected $menu = 'Skor';

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
            'data_skor' => KepSkorModel::whereNull('deleted_at')->get(),
        ];

        return view('kepegawaian.skor.index')->with($data);
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

        return view('kepegawaian.skor.tambah')->with($data);
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
        'status_kehadiran' => 'required|string|max:50',
        'skor'             => 'required|integer|min:0|max:100',
        'keterangan'       => 'nullable|string|max:50',
    ]);

   

    DB::beginTransaction();
    try {
        $data = new KepSkorModel();
        $data->status_kehadiran = $request->status_kehadiran;
        $data->skor             = $request->skor;
        $data->keterangan       = $request->keterangan;
        $data->save();

            DB::commit();
            AlertHelper::addAlert(true);
            return redirect('skor_data');
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
