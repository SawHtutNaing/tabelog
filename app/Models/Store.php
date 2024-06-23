<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function categories()
    {
        $stores = Store::all();
        $arr = [];
        foreach ($stores as $store) {
            // dd($store->getCategory());
            $arr[] =
                [
                    'id' => $store->id,
                    'category_name' => Category::where('id', $store->category_id)->first()->name
                ];
        }
        return $arr;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function leftSeat()
    {

        $bookedSeats = $this->bookings()->sum('people_count');


        $remainingSeats = $this->seating_capacity - $bookedSeats;

        // Ensure remaining seats is not negative
        return max(0, $remainingSeats);
    }

    public function reviews()
    {

        return $this->hasMany(Review::class);
    }
}
