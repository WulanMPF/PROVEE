<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'user'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nik',
        'password',
        'tele_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function file(): HasMany
    {
        return $this->hasMany(FileModel::class, 'id_user', 'id_user');
    }
}
