<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $connection = 'gos_regonline';

    protected $table = 'regonline.reservasi';

    protected $primaryKey = 'ID';

    protected $fillable = ['NORM'];

    public $timestamps = false;

    public function tab()
    {
        return $this->hasMany(TaskAntrianBridge::class, 'NORM', 'NORM')
            ->where('TANGGAL', Carbon::today()->toDateString());
    }

    public function taa()
    {
        return $this->hasMany(TaskActionAntrian::class, 'ANTRIAN', 'ID');
    }
}
