<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaBpjs extends Model
{
    use HasFactory;

    protected $connection = 'gos_bpjs';

    protected $table = 'bpjs.peserta';

    protected $primaryKey = 'nik';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
