<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanMagang extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_magang';

    protected $fillable = [
        'mahasiswa_id',
        'pembimbing_id',
        'surat_permohonan',
        'ktm',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_magang',
        'bidang_diminati',
        'status',
        'alasan_penolakan',
        'tanggal_verifikasi',
        'verified_by',
        'surat_balasan',
        'final_laporan',
        'sertifikat',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_verifikasi' => 'datetime',
        'durasi_magang' => 'integer', // Tambahkan cast untuk memastikan tipe data
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_DITERIMA = 'diterima';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_SELESAI = 'selesai';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class)->withDefault(['user' => ['name' => 'Anonim']]); // Fallback untuk pembimbing anonim
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function laporanMingguan()
    {
        return $this->hasMany(LaporanMingguan::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isDiterima()
    {
        return $this->status === self::STATUS_DITERIMA;
    }

    public function isDitolak()
    {
        return $this->status === self::STATUS_DITOLAK;
    }
}
