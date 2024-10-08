<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKeperawatan extends Model
{
    use Compoships, HasFactory;

    protected $connection = 'gos_medicalrecord';

    protected $table = 'medicalrecord.indikator_keperawatan';

    protected $primaryKey = 'ID';

    protected $guarded = ['ID'];

    public $timestamps = false;

    public function jenis_indikator()
    {
        return $this->belongsTo(JenisIndikatorKeperawatan::class, 'JENIS', 'ID');
    }
}
