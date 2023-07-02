<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tujuan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'tr_tujuan';

    protected $guarded = [
        'id'
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';
}
