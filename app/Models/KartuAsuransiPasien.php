<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuAsuransiPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'kartu_asuransi_pasien';
}
