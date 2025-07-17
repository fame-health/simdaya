<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMingguan extends Model
{
    use HasFactory;

    protected $table = 'laporan_mingguan';

    protected $fillable = [
        'pengajuan_magang_id',
        'mahasiswa_id',
        'minggu_ke',
        'tanggal_mulai',
        'tanggal_selesai',
        'kegiatan',
        'pencapaian',
        'kendala',
        'rencana_minggu_depan',
        'status_approve',
        'approved_by',
        'approved_at',
        'catatan_pembimbing',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function pengajuanMagang()
    {
        return $this->belongsTo(PengajuanMagang::class, 'pengajuan_magang_id');
    }

    public function pembimbingApprover()
    {
        return $this->belongsTo(Pembimbing::class, 'approved_by', 'user_id');
    }
}
