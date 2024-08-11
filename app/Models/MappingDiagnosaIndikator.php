<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingDiagnosaIndikator extends Model
{
    use Compoships, HasFactory;

    protected $connection = 'gos_medicalrecord';

    protected $table = 'medicalrecord.mapping_diagnosa_indikator';

    protected $primaryKey = 'ID';

    protected $fillable = ['JENIS', 'INDIKATOR', 'DIAGNOSA'];

    public $timestamps = false;

    public function jenis_indikator()
    {
        return $this->belongsTo(JenisIndikatorKeperawatan::class, 'JENIS', 'ID');
    }

    public function indikator()
    {
        return $this->belongsTo(IndikatorKeperawatan::class, ['JENIS', 'INDIKATOR'], ['JENIS', 'ID']);
    }

    public function diagnosa()
    {
        return $this->belongsTo(DiagnosaKeperawatan::class, 'DIAGNOSA', 'ID');
    }
}
