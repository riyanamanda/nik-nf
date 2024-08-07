<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.kontak_pasien';

    protected $primaryKey = 'NORM';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
