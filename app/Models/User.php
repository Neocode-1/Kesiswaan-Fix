<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function klasifikasis(): HasMany
    {
        return $this->hasMany(Klasifikasi::class, 'admin_id');
    }
    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'admin_id');
    }
    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class, 'admin_id');
    }
    public function raports(): HasMany
    {
        return $this->hasMany(Raport::class, 'admin_id');
    }
    public function ijazahs(): HasMany
    {
        return $this->hasMany(Ijazah::class, 'admin_id');
    }
}
