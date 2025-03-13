<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SektorModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'sektor'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_sektor';
    public $timestamps = false;

    protected $fillable = [
        'id_wilayah',
        'nama_sektor',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function proviManja(): HasMany
    {
        return $this->hasMany(ProviManjaModel::class, 'id_sektor', 'id_sektor');
    }

    public function pivotEndstate(): HasMany
    {
        return $this->hasMany(PivotEndstateModel::class, 'id_sektor', 'id_sektor');
    }
}
