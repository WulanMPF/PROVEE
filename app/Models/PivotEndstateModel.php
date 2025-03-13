<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PivotEndstateModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'report_pivot_endstate'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_pivot_endstate';
    public $timestamps = false;

    protected $fillable = [
        'id_periode',
        'id_wilayah',
        'id_sektor',
        'pi_total',
        'ps_total',
        'cancel_total',
        'fallout_total',
        'id_endstate',
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode', 'id_periode');
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function sektor(): BelongsTo
    {
        return $this->belongsTo(SektorModel::class, 'id_sektor', 'id_sektor');
    }

    public function endstate()
    {
        return $this->belongsTo(EndstateModel::class, 'id_endstate', 'id_endstate');
    }
}
