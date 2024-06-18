<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Meal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function categories()
    {
        return Meal::distinct()->pluck('category');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function getCategory()
    {
        return   $this->belongsTo(Category::class, 'category', 'id');
    }
    public function getThumbnailUrlAttribute()
    {
        return Storage::url($this->thumbnail);
    }
}
