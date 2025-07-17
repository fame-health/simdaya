<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'pengajuan_magang_id',
        'mahasiswa_id',
        'pembimbing_id',
        'aspek_penilaian',
        'nilai',
        'bobot',
        'keterangan',
        'nilai_akhir',
        'grade',
        'tanggal_penilaian',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'bobot' => 'decimal:2',
        'nilai_akhir' => 'decimal:2',
        'tanggal_penilaian' => 'datetime',
    ];

    public function pengajuanMagang()
    {
        return $this->belongsTo(PengajuanMagang::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class);
    }
}
