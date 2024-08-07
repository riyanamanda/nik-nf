<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $connection = 'gos_pendaftaran';

    protected $table = 'pendaftaran.pendaftaran';

    protected $primaryKey = 'NOMOR';

    protected $fillable = ['NORM', 'NO_KARTU'];

    public $timestamps = false;
}
