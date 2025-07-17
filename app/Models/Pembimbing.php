<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';

    protected $fillable = [
        'user_id',
        'nip',
        'jabatan',
        'bidang_keahlian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(PengajuanMagang::class);
    }

    public function catatanPembimbing()
    {
        return $this->hasMany(CatatanPembimbing::class);
    }
}
