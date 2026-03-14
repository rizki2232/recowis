<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViralTouristSpot extends Model
{
    protected $table = 'viral_tourist_spots';

    protected $fillable = [
        'tourist_spot_id',
        'position'
    ];

    public function touristSpot()
    {
        return $this->belongsTo(TouristSpot::class);
    }
}
