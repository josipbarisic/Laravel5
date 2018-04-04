@extends('layouts.app')

@section('content')
	<h1>Ingredient</h1>
    {!! Form::open(['route' =>'save_ingr', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title', '',['class'=>'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug','Slug')}}
            {{Form::text('slug', '',['class'=>'form-control', 'placeholder' => 'Slug name'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection