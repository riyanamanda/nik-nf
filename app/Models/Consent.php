<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    use HasFactory;

    protected $connection = 'gos_ihs';

    protected $table = 'kemkes-ihs.consent';

    protected $primaryKey = 'refId';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['norm'];

    public $timestamps = false;
}
