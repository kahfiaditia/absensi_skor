<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $menu = 'beranda';

    public function index()
    {

        $data = [
            'title' => $this->title,
            'menu' => $this->menu,
            'label' => $this->menu,
            'jumlahPegawai' => User::where('roles', 'Pegawai')->count(),
            'jumlahAdmin' => User::where('roles', 'Administrator')->count(),
            
        ];
        return view('dashboard.dashboard', $data);
    }
}
