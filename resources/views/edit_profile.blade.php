@extends('layouts/app')

@section('title')
    Profile 
@endsection
@section('content')
<div class="">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
   <form action="{{route('update-profile')}}"  method="POST">
    @csrf
    <p>
        Name - <input type="text" name="name" value="{{$user->name}}">
        </p>
        <p>
        Email - <input type="email"  name="email" value=" {{$user->email}}">
        
        </p>
        <p>
          Address - <input type="text" name="address" value=" {{$user->address??$user->address}}" name="" id="">
        </p>
        {{-- <p>
            Address -  <input type="text" name="" value="{{$user->address??$user->address}}">
          </p> --}}
          <p>
            Postan Code  -  <input type="postal_code" name="po" value="{{$user->postal_code??$user->postal_code}}" name="" id="">
          </p>
          <p>
            Phone Number - <input type="text" name="phone_number" value=" {{$user->phone_number??$user->phone_number}}">
          </p>
          <p>
           DOB -  <input type="date" name="birthday" value="{{$user->birthday??$user->birthday}}">
          </p>
          <p>
            Occupation - <input type="text" name="occupation" value=" {{$user->occupation??$user->occupation}}">
           </p>
      <button type="submit">
        Save
      </button>

   </form>
</div>
  
@endsection
