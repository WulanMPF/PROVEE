<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeriodeModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'periode'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_periode';
    public $timestamps = false;

    protected $fillable = [
        'periode'
    ];

    public function xpro(): HasMany
    {
        return $this->hasMany(XproModel::class, 'id_periode', 'id_periode');
    }

    public function orbit(): HasMany
    {
        return $this->hasMany(OrbitModel::class, 'id_periode', 'id_periode');
    }

    public function endstate(): HasMany
    {
        return $this->hasMany(EndstateModel::class, 'id_periode', 'id_periode');
    }

    public function pivotEndstate(): HasMany
    {
        return $this->hasMany(PivotEndstateModel::class, 'id_periode', 'id_periode');
    }

    public function proviManja(): HasMany
    {
        return $this->hasMany(ProviManjaModel::class, 'id_periode', 'id_periode');
    }

    public function proviKpro(): HasMany
    {
        return $this->hasMany(ProviKproModel::class, 'id_periode', 'id_periode');
    }
}
