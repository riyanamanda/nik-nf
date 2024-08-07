<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienLog extends Model
{
    use HasFactory;

    protected $connection = 'gos_master';

    protected $table = 'master.pasien_log';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
