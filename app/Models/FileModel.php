<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FileModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'upload_file'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_file';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_file',
        'path_file',
        'ket'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    public function xpro(): HasMany
    {
        return $this->hasMany(XproModel::class, 'id_file', 'id_file');
    }

    public function orbit(): HasMany
    {
        return $this->hasMany(OrbitModel::class, 'id_file', 'id_file');
    }

    public function endstate(): HasMany
    {
        return $this->hasMany(EndstateModel::class, 'id_file', 'id_file');
    }

    public function proviManja(): HasMany
    {
        return $this->hasMany(ProviManjaModel::class, 'id_file', 'id_file');
    }
}
