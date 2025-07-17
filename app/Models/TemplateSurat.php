<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $table = 'template_surat';

    protected $fillable = [
        'nama_template',
        'jenis_surat',
        'content_template',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    const JENIS_PENERIMAAN = 'penerimaan';
    const JENIS_PENOLAKAN = 'penolakan';
    const JENIS_SERTIFIKAT = 'sertifikat';

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
