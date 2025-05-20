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
        'id_wilayah',
        'id_sektor',
        'pi_tot',
        'ps_tot',
        'cancel_tot',
        'fallout_tot',
    ];

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
