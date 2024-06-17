@extends('layouts/app')

@section('title')
    Home
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <?php 
        use App\Models\Meal;
        $categories  = Meal::categories()->toArray();
        ?>
        
        <h1>Favorites</h1>
        @foreach (auth()->user()->meals as $item)
        <div class="col-12 col-md-6 col-lg-4 my-4">
            <div class="card">
                <div class="card-body d-flex flex-row">
                    <h5 class="card-title font-weight-bold mb-2">{{ $item->name }}</h5>
                </div>
                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                    <a href="{{ route('meals.show', $item->id) }}">
                        <img class="img-fluid" src="{{ $item->thumbnail }}" alt="Card image cap" />
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="h5">{{ $item->price }}</span>
                        <form action="{{ url('/make_fav/' . $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="border: none; background: none; padding: 0;">
                                <i class="fa-solid fa-heart h5 {{ auth()->user()->hasFavoritedMeal($item->id) ? 'favorited' : '' }}"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Category
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($categories as $category)
                <a class="dropdown-item" href="{{ route('home', ['category' => $category]) }}">{{ $category }}</a>
                @endforeach
            </div>
        </div>

        @foreach ($meal as $item)
        <div class="col-12 col-md-6 col-lg-4 my-4">
            <div class="card">
                <div class="card-body d-flex flex-row">
                    <h5 class="card-title font-weight-bold mb-2">{{ $item->name }}</h5>
                </div>
                <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                    <a href="{{ route('meals.show', $item->id) }}">
                        <img class="img-fluid" src="{{ $item->thumbnail }}" alt="Card image cap" />
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="h5">{{ $item->price }}</span>
                        <form action="{{ url('/make_fav/' . $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="border: none; background: none; padding: 0;">
                                <i class="fa-solid fa-heart h5 {{ auth()->user()->hasFavoritedMeal($item->id) ? 'favorited' : '' }}"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
