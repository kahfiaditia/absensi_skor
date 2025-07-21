<?php

namespace App\Http\Controllers;

use App\Models\KepAbsensiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepRankingController extends Controller
{
     protected $title = 'Ranking';
    protected $menu = 'Ranking';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    // Validate date inputs
    $request->validate([
        'periode_awal' => 'nullable|date',
        'periode_akhir' => 'nullable|date|after_or_equal:periode_awal'
    ]);

    // Set default period (last 7 days)
    $periode_akhir = $request->periode_akhir ? Carbon::parse($request->periode_akhir) : Carbon::now();
    $periode_awal = $request->periode_awal ? Carbon::parse($request->periode_awal) : $periode_akhir->copy()->subDays(6);

    // Limit period to max 7 days
    if ($periode_akhir->diffInDays($periode_awal) > 6) {
        return redirect()->back()->with('error', 'Maksimal periode 7 hari.');
    }

    // Get ranking data with daily scores
    $data_ranking = KepAbsensiModel::select([
            'id_pegawai',
            'nip',
            'nama',
            DB::raw('SUM(skor) as total_skor'),
            DB::raw('AVG(keterlambatan) as rata_keterlambatan'),
            DB::raw('COUNT(*) as jumlah_absensi')
        ])
        ->whereNull('deleted_at')
        ->whereBetween('created_at', [$periode_awal->startOfDay(), $periode_akhir->endOfDay()])
        ->groupBy('id_pegawai', 'nip', 'nama')
        ->orderByDesc('total_skor')
        ->get();

    // Get daily data for chart
    $daily_data = KepAbsensiModel::select([
            DB::raw('DATE(created_at) as tanggal'),
            'nama',
            DB::raw('SUM(skor) as skor_harian')
        ])
        ->whereNull('deleted_at')
        ->whereBetween('created_at', [$periode_awal->startOfDay(), $periode_akhir->endOfDay()])
        ->groupBy('tanggal', 'nama')
        ->orderBy('tanggal')
        ->get()
        ->groupBy('nama');

    return view('kepegawaian.ranking.index', [
        'title' => 'Ranking Pegawai',
        'menu' => 'ranking',
        'data_ranking' => $data_ranking,
        'daily_data' => $daily_data,
        'periode_awal' => $periode_awal->format('Y-m-d'),
        'periode_akhir' => $periode_akhir->format('Y-m-d'),
        'date_range' => $this->generateDateRange($periode_awal, $periode_akhir)
    ]);
}

private function generateDateRange(Carbon $start_date, Carbon $end_date)
{
    $dates = [];
    for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
        $dates[] = $date->format('Y-m-d');
    }
    return $dates;
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
