@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card h-75 w-50">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{ $meal->name }}</h5>
                        <img class="img-fluid h-50 mb-3" src="{{ $meal->thumbnail }}" alt="Meal Image">
                        <p class="card-text">{{ $meal->description }}</p>
                        <p class="card-text">Price: <span id="meal-price">{{ $meal->price }}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form id="booking-form" action="{{ route('order_meal', $meal->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="booking-date">Select Date</label>
                        <input type="date" class="form-control" id="booking-date" name="booking_time" required>
                    </div>
                    <div class="form-group">
                        <label for="item-number">Number of Items</label>
                        <input type="number" class="form-control" id="item-number" name="item_number" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="total-price">Total Price</label>
                        <input type="text" class="form-control" id="total-price" name="total_price" readonly>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">{{ auth()->user()->hasFavoritedMeal($meal->id) ? 'Favorited' : 'Add to Favorites' }}</button> --}}
                    @auth
                    
                    @if(Auth::user()->user_type =='premium')
                    <button type="submit" class="btn btn-primary">Order</button>

                    @endif 

                    @endauth
                        
                </form>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function calculateTotalPrice() {
                var price = parseFloat(document.getElementById('meal-price').textContent);
                var itemNumber = parseInt(document.getElementById('item-number').value);
                var totalPrice = price * itemNumber;
                document.getElementById('total-price').value = totalPrice.toFixed(2);
            }

            // Initial calculation
            calculateTotalPrice();

            // Recalculate total price on item number change
            document.getElementById('item-number').addEventListener('input', function() {
                
                calculateTotalPrice();
            });
        });
    </script>
@endsection
