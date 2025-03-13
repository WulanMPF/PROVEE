<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WilayahModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'wilayah'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_wilayah';
    public $timestamps = false;

    protected $fillable = [
        'nama_wilayah'
    ];

    public function xpro(): HasMany
    {
        return $this->hasMany(XproModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function orbit(): HasMany
    {
        return $this->hasMany(OrbitModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function endstate(): HasMany
    {
        return $this->hasMany(EndstateModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function pivotEndstate(): HasMany
    {
        return $this->hasMany(PivotEndstateModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function proviManja(): HasMany
    {
        return $this->hasMany(ProviManjaModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function proviKpro(): HasMany
    {
        return $this->hasMany(ProviKproModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function sektor(): HasMany
    {
        return $this->hasMany(SektorModel::class, 'id_wilayah', 'id_wilayah');
    }
}
