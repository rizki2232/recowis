<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'open_time',
        'close_time',
        'ticket_price',
        'address',
        'location',
        'created_by',
    ];
    use HasFactory;
}
