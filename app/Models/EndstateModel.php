<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EndstateModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'report_endstate'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_endstate';
    public $timestamps = false;

    protected $fillable = [
        'id_wilayah',
        'pi_hi',
        'ps_hi',
        'accomp',
        'pi_tot',
        'ps_tot',
        'target_tot',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function pivotEndstate()
    {
        return $this->hasOne(PivotEndstateModel::class, 'id_endstate', 'id_endstate');
    }

    public function proviKpro()
    {
        return $this->hasOne(ProviKproModel::class, 'id_endstate', 'id_endstate');
    }
}
