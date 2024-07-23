<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $connection = 'gos_ihs';

    protected $table = 'patient';

    protected $primaryKey = 'refId';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['nik', 'statusRequest'];

    public $timestamps = false;

    public function identitas()
    {
        return $this->belongsTo(Pasien::class, 'refId', 'NORM');
    }

    public function kartu()
    {
        return $this->belongsTo(KartuIdentitasPasien::class, 'refId', 'NORM');
    }

    public function asuransi()
    {
        return $this->belongsTo(KartuAsuransiPasien::class, 'refId', 'NORM');
    }
}
