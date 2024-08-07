<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIndikatorKeperawatan extends Model
{
    use HasFactory;

    protected $connection = 'gos_medicalrecord';

    protected $table = 'medicalrecord.jenis_indikator_keperawatan';

    protected $primaryKey = 'ID';

    protected $fillable = [];

    public $timestamps = false;
}
