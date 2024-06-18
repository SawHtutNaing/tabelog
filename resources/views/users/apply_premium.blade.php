@extends('layouts.app')

@section('content')
<div>
    apply for premium 

</div>
<h1>
    To becom premius member ,  you need to pay for 300 
</h1>
<form action="{{route('users.apply_permium')}}" method="POST" class=" from">
    @csrf
    <input type="number" value="300" readonly class=" form-control-input">
    <button class=" btn-primary">
        pay 
    </button>
</form>

@endsection
