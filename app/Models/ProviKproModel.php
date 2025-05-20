<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProviKproModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'report_provi_kpro'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_provi_kpro';
    public $timestamps = false;

    protected $fillable = [
        'id_wilayah',
        'id_endstate',
        'target_per_hari',
        'deviasi',
        'perhitungan_hari',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function endstate()
    {
        return $this->belongsTo(EndstateModel::class, 'id_endstate', 'id_endstate');
    }

    public function provimanja()
    {
        return $this->belongsTo(ProviManjaModel::class, 'id_provi_manja', 'id_provi_manja');
    }
}
