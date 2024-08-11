<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingIntervensiIndikator extends Model
{
    use Compoships, HasFactory;

    protected $connection = 'gos_medicalrecord';

    protected $table = 'medicalrecord.mapping_intervensi_indikator';

    protected $primaryKey = 'ID';

    protected $fillable = ['JENIS', 'INDIKATOR', 'INTERVENSI'];

    public $timestamps = false;

    public function jenis_indikator()
    {
        return $this->belongsTo(JenisIndikatorKeperawatan::class, 'JENIS', 'ID');
    }

    public function indikator()
    {
        return $this->belongsTo(IndikatorKeperawatan::class, ['JENIS', 'INDIKATOR'], ['JENIS', 'ID']);
    }

    public function jenis_intervensi()
    {
        return $this->belongsTo(IndikatorKeperawatan::class, 'INTERVENSI', 'ID')->where('JENIS', 5);
    }
}
