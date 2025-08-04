<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\LaporanMingguan;
use App\Models\CatatanPembimbing;
use App\Models\PengajuanMagang;
use App\Models\Penilaian;

class MahasiswaPrint extends Component
{
    public $steps = [];
    public $pengajuanMagang;
    public $penilaian;

    public function mount()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            abort(403, 'Data mahasiswa tidak ditemukan.');
        }

        // Fetch the latest internship application (pengajuan_magang) for the student
        $this->pengajuanMagang = PengajuanMagang::where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', [PengajuanMagang::STATUS_DITERIMA, PengajuanMagang::STATUS_SELESAI])
            ->latest()
            ->first();

        // Fetch weekly reports (laporan_mingguan) and transform them into steps
        $laporanMingguan = LaporanMingguan::where('mahasiswa_id', $mahasiswa->id)
            ->where('pengajuan_magang_id', optional($this->pengajuanMagang)->id)
            ->orderBy('minggu_ke')
            ->get();

        $this->steps = $laporanMingguan->map(function ($laporan) {
            return [
                'title' => "Minggu ke-{$laporan->minggu_ke}",
                'description' => $laporan->kegiatan,
                'completed' => $laporan->status_approve == 1,
                'active' => $laporan->status_approve == 0,
                'completed_at' => $laporan->approved_at ? \Carbon\Carbon::parse($laporan->approved_at)->format('d M Y') : null,
                'pencapaian' => $laporan->pencapaian,
                'kendala' => $laporan->kendala,
                'rencana_minggu_depan' => $laporan->rencana_minggu_depan,
                'catatan_pembimbing' => $laporan->catatan_pembimbing,
            ];
        })->toArray();

        // Fetch evaluation data (penilaian) for the student
        $this->penilaian = Penilaian::where('mahasiswa_id', $mahasiswa->id)
            ->when($this->pengajuanMagang && $this->pengajuanMagang->pembimbing_id, function ($query) {
                return $query->where('pembimbing_id', $this->pengajuanMagang->pembimbing_id);
            })
            ->get();
    }

    public function printPdf()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::with('user')->where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            abort(403, 'Data mahasiswa tidak ditemukan.');
        }

        // Fetch catatan pembimbing
        $catatanPembimbing = CatatanPembimbing::where('mahasiswa_id', $mahasiswa->id)
            ->where('pengajuan_magang_id', optional($this->pengajuanMagang)->id)
            ->get();

        // Prepare data for the PDF view
        $data = [
            'mahasiswa' => $mahasiswa,
            'steps' => $this->steps,
            'completedCount' => count(array_filter($this->steps, fn($step) => $step['completed'])),
            'totalSteps' => count($this->steps),
            'pengajuanMagang' => $this->pengajuanMagang,
            'penilaian' => $this->penilaian,
            'catatanPembimbing' => $catatanPembimbing,
        ];

        // Generate PDF with name from User model
        $pdf = Pdf::loadView('livewire.pdf.mahasiswa-progress', $data);
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'progress-magang-' . ($mahasiswa->user->name ?? 'mahasiswa') . '.pdf'
        );
    }

    public function render()
    {
        return view('livewire.mahasiswa-print');
    }
}
