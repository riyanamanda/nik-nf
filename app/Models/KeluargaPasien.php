<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.keluarga_pasien';

    protected $primaryKey = 'ID';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
