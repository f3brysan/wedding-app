<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory, Uuid;
    protected $table = 'ms_galery';

    protected $guarded = [
        'id'
    ];

    public $incrementing = false;

    protected $keyType = 'uuid';
}
