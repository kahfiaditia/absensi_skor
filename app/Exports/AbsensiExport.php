<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AbsensiExport implements WithColumnFormatting, FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    use Exportable;

    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function query()
    {
        $absensi = DB::table('kep_absensi')
            ->select(
                'kep_absensi.id',
                'nip',
                'nama',
                'jam_masuk',
                'jam_pulang',
                'hari_absen',
                'absen_karyawan',
                'keterlambatan',
                'id_skor',
                'skor',
                'keterangan',
                'created_at'
            )
            ->whereNull('kep_absensi.deleted_at')
            ->orderBy('kep_absensi.id', 'asc');

        if (!empty($this->data['search_manual'])) {
            $search = $this->data['search_manual'];
            $absensi->where(function ($query) use ($search) {
                $query->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('jam_masuk', 'like', '%' . $search . '%')
                    ->orWhere('jam_pulang', 'like', '%' . $search . '%')
                    ->orWhere('hari_absen', 'like', '%' . $search . '%')
                    ->orWhere('absen_karyawan', 'like', '%' . $search . '%')
                    ->orWhere('keterlambatan', 'like', '%' . $search . '%')
                    ->orWhere('skor', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%');
            });
        } else {
            if (!empty($this->data['nip'])) {
                $absensi->where('nip', $this->data['nip']);
            }

            if (!empty($this->data['tgl_start']) && !empty($this->data['tgl_end'])) {
                $absensi->whereBetween('created_at', [
                    $this->data['tgl_start'] . ' 00:00:00',
                    $this->data['tgl_end'] . ' 23:59:59'
                ]);
            }

            if (!empty($this->data['nama'])) {
                $absensi->where('nama', 'like', '%' . $this->data['nama'] . '%');
            }

           
        }

        return $absensi;
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIP',
            'Nama',
            'Jam Masuk',
            'Jam Pulang',
            'Hari Absen',
            'Absen Karyawan',
            'Keterlambatan (menit)',
            'ID Skor',
            'Skor',
            'Keterangan',
            'Tanggal Dibuat'
        ];
    }

    public function map($absensi): array
    {
        return [
            $absensi->id,
            $absensi->nip,
            $absensi->nama,
            $absensi->jam_masuk,
            $absensi->jam_pulang,
            $absensi->hari_absen,
            $absensi->absen_karyawan,
            $absensi->keterlambatan,
            $absensi->id_skor,
            $absensi->skor,
            $absensi->keterangan,
            $absensi->created_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:L1')
                    ->getFont()
                    ->setBold(true)
                    ->getColor()->setARGB('FFFFFFFF');
                
                $event->sheet->getDelegate()->getStyle('A1:L1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF4F81BD');
            },
        ];
    }
}