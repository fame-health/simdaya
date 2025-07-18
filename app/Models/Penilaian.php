<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pengajuan_magang_id
 * @property int $mahasiswa_id
 * @property int $pembimbing_id
 * @property string $aspek_penilaian
 * @property numeric $nilai
 * @property numeric $bobot
 * @property string|null $keterangan
 * @property numeric $nilai_akhir
 * @property string $grade
 * @property \Illuminate\Support\Carbon $tanggal_penilaian
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Mahasiswa $mahasiswa
 * @property-read \App\Models\Pembimbing $pembimbing
 * @property-read \App\Models\PengajuanMagang $pengajuanMagang
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereAspekPenilaian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereBobot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereMahasiswaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereNilaiAkhir($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian wherePembimbingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian wherePengajuanMagangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereTanggalPenilaian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penilaian whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
