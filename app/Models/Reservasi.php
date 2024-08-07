<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $connection = 'gos_regonline';

    protected $table = 'regonline.reservasi';

    protected $primaryKey = 'ID';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
