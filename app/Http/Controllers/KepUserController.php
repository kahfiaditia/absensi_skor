<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Helper\AlertHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $request->validate([
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users,email|max:50',
                'password' => 'required|string|min:8|max:50',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:50',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            DB::beginTransaction();

            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->nip = '89565577';
                $user->pin = '1234'; // Wajib isi karena kolom tidak nullable
                $user->password = Hash::make($request->password);
                $user->phone = $request->phone ?? null;
                $user->address = $request->address ?? null;
                $user->roles = 'Administrator';
                $user->email_verified_at = now();

                // Avatar logic
                if ($request->hasFile('avatar')) {
                    $fileName = Carbon::now()->format('ymdhis') . '_' . Str::random(25) . '.' . $request->avatar->extension();
                    $request->avatar->move(public_path('assets/avatar'), $fileName);
                    $user->avatar = $fileName;
                }

                $user->save();

                DB::commit();
                AlertHelper::addAlert(true);
                return redirect('user_admin');

            } catch (\Throwable $err) {
                DB::rollback();
                AlertHelper::addAlert(false);
                return back()->withInput()->with('error', 'Gagal menambahkan pengguna: ' . $err->getMessage());
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
