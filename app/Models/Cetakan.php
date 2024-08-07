<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cetakan extends Model
{
    use HasFactory;

    protected $connection = 'gos_cetakan';

    protected $table = 'cetakan.kartu_pasien';

    protected $primaryKey = 'ID';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
