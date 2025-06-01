<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FileModel;

class UserModel extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'user'; // Sesuai dengan tabel database
    protected $primaryKey = 'id_user';
    public $timestamps = false; // Nonaktifkan timestamps jika tidak ada di database

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
        return $this->hasMany(FileModel::class, 'id_user');
    }
}
