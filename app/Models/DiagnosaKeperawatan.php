<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaKeperawatan extends Model
{
    use HasFactory;

    protected $connection = 'gos_medicalrecord';

    protected $table = 'medicalrecord.diagnosa_keperawatan';

    protected $primaryKey = 'ID';

    protected $guarded = [];

    public $timestamps = false;
}
