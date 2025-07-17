<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'universitas',
        'fakultas',
        'jurusan',
        'semester',
        'ipk',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'ipk' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanMagang::class);
    }

    public function laporanMingguan()
    {
        return $this->hasMany(LaporanMingguan::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
