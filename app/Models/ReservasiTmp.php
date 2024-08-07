<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiTmp extends Model
{
    use HasFactory;

    protected $connection = 'gos_regonline';

    protected $table = 'regonline.reservasi_tmp';

    protected $primaryKey = 'ID';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
