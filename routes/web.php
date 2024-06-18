<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealOrderController;

use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Models\Booking;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('auth')->group(function () {
    Route::get('/login', fn () => view('auth/login'))->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


    Route::post('/register', [AuthController::class, 'makeRegister'])->name('auth.register');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
});
Route::middleware('auth')->group(function () {

    Route::get('users/mypage/register_card', [PaymentController::class, 'register_card'])->name('mypage.register_card');
    Route::post('users/mypage/token', [PaymentController::class, 'token'])->name('mypage.token');

    Route::post('/make_fav/{id}', function ($id) {
        $user = Auth::user();
        $meal = Meal::findOrFail($id);

        if ($user->meals()->where('meal_id', $id)->exists()) {
            // Meal is already favorited, unfavorite it
            $user->meals()->detach($id);
            return redirect()->back(); // 
        } else {
            // Meal is not favorited, favorite it
            $user->meals()->attach($id);
            return redirect()->back(); // 
        }
    })->name('make_fav');



    Route::get('booking', function () {
        $bookings = Booking::where('user_id', auth()->id())->with('meal')->get();


        return view('booking', compact('bookings'));
    })->name('booking');
});

Route::get('/meals/{id}', [MealController::class, 'show'])->name('meals.show')->middleware('auth');
Route::post('/order_meal/{id}', [BookingController::class, 'store'])->name('order_meal')->middleware('auth');
Route::get('/apply-premium', fn () => view('users/apply_premium'))->name('users.apply_permium')->middleware('auth');

//apply for premium 
Route::post('/apply-premium', [PaymentController::class, 'getPremium'])->name('users.apply_permium')->middleware('auth');
