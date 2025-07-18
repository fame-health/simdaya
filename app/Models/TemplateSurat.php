<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama_template
 * @property string $jenis_surat
 * @property string $content_template
 * @property bool $is_active
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereContentTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereJenisSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereNamaTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TemplateSurat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
