<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAntrianBridge extends Model
{
    use HasFactory;

    protected $connection = 'gos_regonline';

    protected $table = 'regonline.task_antrian_bridge';

    protected $primaryKey = 'NO_KARTU';

    protected $fillable = ['NORM'];

    public $timestamps = false;
}
