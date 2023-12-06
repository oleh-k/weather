<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastArchive extends Model
{
    use HasFactory;

    protected $table = 'forecast_archives';

    protected $fillable = [
        'name',
        'city_id',
        'user_id',
    ];

    protected $visible = [
        'id',
        'name',
        'city_id',
        'user_id',
    ];
}
