<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $connection = 'gos_ihs';

    protected $table = 'patient';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public function identitas()
    {
        return $this->belongsTo(Pasien::class, 'refId', 'NORM');
    }
}
