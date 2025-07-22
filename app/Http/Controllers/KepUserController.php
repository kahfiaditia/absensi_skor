<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KepUserController extends Controller
{
    protected $title = 'User';
    protected $menu = 'User Administrator';
    
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
            'label' => "Data Admin",
            'data_user' => User::where('roles', 'administrator')
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get(),
        ];

        return view('kepegawaian.user.index')->with($data);
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
            'label' => $this->title,
            
        ];
        return view('kepegawaian.user.tambah')->with($data);
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
