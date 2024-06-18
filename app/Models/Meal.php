<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Meal extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getCategory()
    {
        return   $this->belongsTo(Category::class, 'category', 'id');
    }
    public static function categories()
    {
        $meals = Meal::all();
        $arr = [];
        foreach ($meals as $meal) {
            // dd($meal->getCategory());
            $arr[] =
                [
                    'id' => $meal->id,
                    'category_name' => Category::where('id', $meal->category)->first()->name
                ];
        }
        return $arr;
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getThumbnailUrlAttribute()
    {
        return Storage::url($this->thumbnail);
    }
}
