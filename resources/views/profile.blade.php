@extends('layouts/app')

@section('title')
    Profile 
@endsection
@section('content')
<p>
Name - {{$user->name}}
</p>
<p>
Email - {{$user->email}}

</p>
<p>
  Address -  {{$user->address??$user->address}}
</p>
<p>
    Address -  {{$user->address??$user->address}}
  </p>
  <p>
    Postan Code  -  {{$user->postal_code??$user->postal_code}}
  </p>
  <p>
    Phone Number -  {{$user->phone_number??$user->phone_number}}
  </p>
  <p>
   DOB -  {{$user->birthday??$user->birthday}}
  </p>
  <p>
    Occupation -  {{$user->occupation??$user->occupation}}
   </p>
   <a href="{{route('edit-profile')}}">Edit</a>
  
@endsection
