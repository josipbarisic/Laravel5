@extends('layouts.app')

@section('content')
    <br>
    <br>
    <h1><strong>{{$onemeal->title}}</strong></h1>
    
        <div class="jumbotron">
        {!!$onemeal->slug!!}
        </div>

        <div class="jumbotron">
        <p><h3>Translations: </h3></p>
        <!-- @foreach ($onemeal->meal_translations as $one)
            

            @if ($one->where('language_id', 1))
                <p>English: </p>{{$one->title}}
                
            @elseif ($one->where('language_id', 2))
                <p>Spanish: </p>{{$one->title}}

            @else
                <p>French: </p>{{$one->title}}
            @endif 

        @endforeach -->
        </div>
       
        <hr>
@endsection



