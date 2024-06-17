<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);

        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->meal_id = $meal->id;
        $booking->booking_time = $request->input('booking_time');
        $booking->item_number = $request->input('item_number');
        $booking->total_price = $request->input('total_price');
        $booking->save();


        $pay_jp_secret = env('PAYJP_SECRET_KEY');
        \Payjp\Payjp::setApiKey($pay_jp_secret);

        $user = Auth::user();

        $res = \Payjp\Charge::create(
            [
                "customer" => $user->name,
                "amount" =>  $booking->total_price,
                "currency" => 'jpy'
            ]
        );
        return redirect()->route('home');
    }
}
