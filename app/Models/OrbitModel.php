<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrbitModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'report_orbit'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_orbit';
    public $timestamps = false;

    protected $fillable = [
        'id_wilayah',
        'pi_hi',
        'ps_hi',
        'pi_tot',
        'ps_tot',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }
}
