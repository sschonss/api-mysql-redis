<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'sensor_01',
        'sensor_02',
        'sensor_03',
        'sensor_04',
        'sensor_05',
        'sensor_06',
        'sensor_07',
        'sensor_08',
        'sensor_09',
        'sensor_10',
        'sensor_11',
        'sensor_12',
        'sensor_13',
        'sensor_14',
        'sensor_15'
    ];


}
