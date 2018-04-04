@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <br>
    <br>
    <h1><strong>{{$category->title}}</strong></h1>
    
        <div class="jumbotron">
        {!!$category->slug!!}
        </div>
        
@endsection