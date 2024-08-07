<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuAsuransiPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.kartu_asuransi_pasien';

    protected $primaryKey = 'NORM';

    protected $fillable = ['NOMOR', 'NORM'];

    public $timestamps = false;
}
