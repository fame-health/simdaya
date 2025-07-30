<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
use App\Models\LaporanMingguan;
use App\Models\Penilaian;

class ProgressSteps extends Widget
{
    protected static string $view = 'filament.widgets.progress-steps';

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'mahasiswa';
    }

    public function getStepsData(): array
    {
        $user = Auth::user();
        $steps = [
            [
                'title' => 'Isi Data Mahasiswa',
                'description' => 'Mahasiswa wajib mengisi data mahasiswa.',
                'completed' => false,
                'active' => false,
                'url' => route('filament.dashboard.resources.mahasiswas.create'),
            ],
            [
                'title' => 'Pengajuan Magang',
                'description' => 'Submit pengajuan magang.',
                'completed' => false,
                'active' => false,
                'url' => route('filament.dashboard.resources.pengajuan-magangs.create'),
            ],
            [
                'title' => 'Logbook',
                'description' => 'Mahasiswa wajib mengisi laporan mingguan sesuai durasi magang.',
                'completed' => false,
                'active' => false,
                'url' => route('filament.dashboard.resources.laporan-mingguans.create'),
            ],
            [
                'title' => 'Penilaian',
                'description' => 'Menunggu penilaian dari pembimbing.',
                'completed' => false,
                'active' => false,
                'url' => route('filament.dashboard.resources.penilaians.index'),
            ],
            [
                'title' => 'Laporan Akhir',
                'description' => 'Upload laporan akhir dan dapatkan sertifikat.',
                'completed' => false,
                'active' => false,
                'url' => route('filament.dashboard.resources.final-laporans.index'),
            ],
        ];

        if ($user && $user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

            // Step 1: Mahasiswa
            if ($mahasiswa) {
                $steps[0]['completed'] = true;
                $steps[0]['url'] = route('filament.dashboard.resources.mahasiswas.edit', $mahasiswa->id);
            } else {
                $steps[0]['active'] = true;
            }

            // Step 2: Pengajuan Magang
            if ($mahasiswa) {
                $pengajuan = PengajuanMagang::where('mahasiswa_id', $mahasiswa->id)
                    ->whereIn('status', [PengajuanMagang::STATUS_DITERIMA, PengajuanMagang::STATUS_SELESAI])
                    ->first();

                if ($pengajuan) {
                    $steps[1]['completed'] = true;
                    $steps[1]['url'] = route('filament.dashboard.resources.pengajuan-magangs.index');
                } else {
                    $steps[1]['active'] = !$steps[0]['active'];
                }

                // Step 3: Laporan Mingguan
                if ($pengajuan) {
                    $durasiMagang = $pengajuan->durasi_magang ?? 0;
                    $laporanDisetujui = LaporanMingguan::where('mahasiswa_id', $mahasiswa->id)
                        ->where('status_approve', true)
                        ->count();

                    if ($laporanDisetujui >= $durasiMagang && $durasiMagang > 0) {
                        $steps[2]['completed'] = true;
                    } else {
                        $steps[2]['active'] = !$steps[1]['active'];
                    }

                    // Step 4: Penilaian
                    if ($steps[2]['completed']) {
                        $penilaian = Penilaian::where('mahasiswa_id', $mahasiswa->id)
                            ->whereNotNull('nilai')
                            ->first();

                        if ($penilaian) {
                            $steps[3]['completed'] = true;
                        } else {
                            $steps[3]['active'] = true;
                        }
                    }

                    // Step 5: Laporan Akhir
                    if ($steps[3]['completed']) {
                        if ($pengajuan->final_laporan && $pengajuan->sertifikat) {
                            $steps[4]['completed'] = true;
                        } else {
                            $steps[4]['active'] = true;
                        }
                    }
                }
            }
        }

        return $steps;
    }
}
