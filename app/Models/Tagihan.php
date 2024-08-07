<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $connection = 'gos_pembayaran';

    protected $table = 'pembayaran.tagihan';

    protected $primaryKey = 'ID';

    protected $fillable = ['REF'];

    public $timestamps = false;
}
