@extends('layouts.app')

@section('content')
<?php 
$user = Auth::user();

?>
<div>
    apply for premium 

</div>
<h1>
    To becom premium member ,  you need to pay for 300  each month 
</h1>
@if(Auth::user()->user_type == 'normal')
<form action="{{route('users.apply_permium')}}" method="POST" class=" from">
    @csrf
    <input type="number" value="300" readonly class=" form-control-input">
    <button class=" btn-primary">
        pay 
    </button>
</form>
@elseif(Auth::user()->user_type == 'premium')
<form action="{{route('cancelPlan')}}" method="POST">
    @csrf
    <button class=" btn-danger "> Cancel Plan </button>
</form>
@endif 

@endsection
