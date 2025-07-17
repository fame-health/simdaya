<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    const ROLE_MAHASISWA = 'mahasiswa';
    const ROLE_ADMIN = 'admin';
    const ROLE_PEMBIMBING = 'pembimbing';

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function pembimbing()
    {
        return $this->hasOne(Pembimbing::class);
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isMahasiswa()
    {
        return $this->role === self::ROLE_MAHASISWA;
    }

    public function isPembimbing()
    {
        return $this->role === self::ROLE_PEMBIMBING;
    }
}
