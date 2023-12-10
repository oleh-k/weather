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

    // Define a relationship with City
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    // Define the one-to-many relationship with ForecastData
    public function forecastData()
    {
        return $this->hasMany(ForecastData::class, 'forecast_archive_id');
    }

    // Define the inverse of the one-to-many relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
