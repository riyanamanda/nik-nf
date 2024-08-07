<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratRujukanPasien extends Model
{
    use HasFactory;

    protected $connection = 'gos_pendaftaran';

    protected $table = 'pendaftaran.surat_rujukan_pasien';

    protected $primaryKey = 'ID';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
