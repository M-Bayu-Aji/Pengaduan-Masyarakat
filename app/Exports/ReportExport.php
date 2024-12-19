<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Report;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    private $no = 0;
    private $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = Report::with('user');

        if ($this->date) {
            $query->whereDate('created_at', $this->date);
        }

        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Email Pelaport',
            'Dilaporkan Pada Tanggal',
            'Deskripsi Pengaduan',
            'Url Gambar',
            'Lokasi',
            'Jumlah Voting',
            'Status Pengaduang',
            'Progress Tanggapan',
            'Staff Terkait'
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($report): array
    {
        // increment no urut
        $this->no++;

        // Skip records that don't match the logged-in user's province
        if ($report->province !== auth()->user()->staffProvince->province) {
            return [];
        }

        return [
            $this->no,
            $report->user->email,
            Carbon::parse($report->created_at)->locale('id')->isoFormat('dddd, D MMMM Y - H:mm:ss'),
            $report->description,
            $report->image ? url('images/' . $report->image) : '-',
            $report->village . ', ' . $report->district . ', ' . $report->regency . ', ' . $report->province,
            $report->voting,
            $report->status ?? 'Belum Ditanggapi',
            $report->progress ?? 'Belum Diproses',
            $report->staff->user->email ?? '-',
        ];
    }
}
