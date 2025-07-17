<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPembimbing extends Model
{
    use HasFactory;

    protected $table = 'catatan_pembimbing';

    protected $fillable = [
        'pengajuan_magang_id',
        'pembimbing_id',
        'mahasiswa_id',
        'tanggal_catatan',
        'judul_catatan',
        'isi_catatan',
        'tipe_catatan',
        'is_read',
    ];

    protected $casts = [
        'tanggal_catatan' => 'datetime',
        'is_read' => 'boolean',
    ];

    const TIPE_FEEDBACK = 'feedback';
    const TIPE_EVALUASI = 'evaluasi';
    const TIPE_BIMBINGAN = 'bimbingan';

    public function pengajuanMagang()
    {
        return $this->belongsTo(PengajuanMagang::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
