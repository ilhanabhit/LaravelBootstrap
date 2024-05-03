<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class akun_admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "pegawai";
    protected $primaryKey = "nip";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip', 'nama', 'email', 'tanggal_lahir', 'jenis_kelamin', 'jabatan', 'kata_sandi',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    /**
     * Set password attribute with MD5 encryption.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['kata_sandi'] = md5($value);
    }
}
