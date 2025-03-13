<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ProviManjaModel extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    protected $table = 'report_provi_manja'; // Sesuai dengan tabel pada database
    protected $primaryKey = 'id_provi_manja';
    public $timestamps = false;

    protected $fillable = [
        'id_periode',
        'id_wilayah',
        'id_sektor',
        'manja_expired_h-1',
        'manja_hi',
        'saldo_manja_h+1',
        'saldo_manja_h+2',
        'total',
        'id_file',
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodeModel::class, 'id_periode', 'id_periode');
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(WilayahModel::class, 'id_wilayah', 'id_wilayah');
    }

    public function sektor()
    {
        return $this->belongsTo(SektorModel::class, 'id_sektor', 'id_sektor');
    }

    public function file()
    {
        return $this->belongsTo(FileModel::class, 'id_file', 'id_file');
    }
}
