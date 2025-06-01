<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class XproModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'report_xpro'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_xpro';
    public $timestamps = false;

    protected $fillable = [
        'id_periode',
        'id_wilayah',
        're_hi',
        'pi_hi',
        'ps_hi',
        'accomp',
        're_tot',
        'pi_tot',
        'ps_tot',
        'id_file',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }
}
