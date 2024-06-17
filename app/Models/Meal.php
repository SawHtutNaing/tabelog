<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    public static function categories()
    {
        return Meal::distinct()->pluck('category');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
