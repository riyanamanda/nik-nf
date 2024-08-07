<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakKeluargaPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.pasien';

    protected $primaryKey = 'NORM';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
