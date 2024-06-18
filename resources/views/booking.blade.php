@extends('layouts.app')

@section('title')
    My Bookings
@endsection

@section('content')
<div class="container mt-5">
    <h1>My Bookings</h1>
    <div class="row">
        @foreach ($bookings as $booking)
        <div class="col-12 col-md-6 col-lg-4 my-4">
            <div class="card">
                <div class="card-body d-flex flex-row">
                    <h5 class="card-title font-weight-bold mb-2">{{ $booking->meal->name }}</h5>
                </div>
                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                    <img class="img-fluid" src="{{ $booking->meal->thumbnail }}" alt="Card image cap" />
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
                <div class="card-body">
                    <p>Booking Date: {{ date('Y-m-d', strtotime($booking->booking_time)); }}</p>
                    <p>Number of Items: {{ $booking->item_number }}</p>
                    <p>Total Price: {{ $booking->total_price }}</p>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
