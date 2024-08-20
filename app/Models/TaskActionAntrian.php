<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskActionAntrian extends Model
{
    use HasFactory;

    protected $connection = 'gos_regonline';

    protected $table = 'regonline.task_action_antrian';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'TASK_ID',
        'ANTRIAN',
        'TANGGAL',
        'WAKTU',
        'STATUS',
    ];

    public $timestamps = false;
}
