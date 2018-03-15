@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <br>
    <br>
    <h1><strong>{{$post->title}}</strong></h1>
    
        <div class="jumbotron">
        {!!$post->slug!!}
        </div>
        <hr>
            <small>Writen on {{$post->created_at}}</small>
        </hr>
        <hr>
@endsection