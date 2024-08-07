<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $connection = 'gos_regonline';

    protected $table = 'regonline.peserta';

    protected $primaryKey = 'nik';

    protected $fillable = ['norm'];

    public $timestamps = false;
}
