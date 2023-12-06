<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastData extends Model
{
    use HasFactory;

    protected $table = 'forecast_data';

    protected $fillable = [
        'user_id',
        'forecast_archive_id',
        'date',
        'maxtemp',
        'mintemp',
        'avgtemp',
        'daily_chance_of_rain',
        'daily_chance_of_snow',
    ];

    protected $visible = [
        'id',
        'user_id',
        'forecast_archive_id',
        'date',
        'maxtemp',
        'mintemp',
        'avgtemp',
        'daily_chance_of_rain',
        'daily_chance_of_snow',
    ];
}
