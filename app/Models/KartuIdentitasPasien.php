<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuIdentitasPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.kartu_identitas_pasien';

    protected $primaryKey = 'NORM';

    protected $fillable = ['NOMOR'];

    public $timestamps = false;
}
