<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.pasien';

    protected $primaryKey = 'NORM';

    protected $fillable = ['NORM'];

    public $timestamps = false;

    public function ktp()
    {
        return $this->belongsTo(KartuIdentitasPasien::class, 'NORM', 'NORM');
    }

    public function asuransi()
    {
        return $this->belongsTo(KartuAsuransiPasien::class, 'NORM', 'NORM');
    }

    public function keluarga()
    {
        return $this->belongsTo(KeluargaPasien::class, 'NORM', 'NORM');
    }

    public function kontak_keluarga()
    {
        return $this->belongsTo(KontakKeluargaPasien::class, 'NORM', 'NORM');
    }

    public function kontak_pasien()
    {
        return $this->belongsTo(KontakPasien::class, 'NORM', 'NORM');
    }
}
