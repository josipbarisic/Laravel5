@extends('layouts.app')

@section('content')
	<h1>Create Category</h1>
    {!! Form::open(['route' =>'saved', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title', '',['class'=>'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug','Slug')}}
            {{Form::textarea('slug', '',['class'=>'form-control', 'placeholder' => 'Slug name'])}}
        </div>
        <div class="form-group">
            {{Form::label('meal_id','Meal ID')}}
            {{Form::text('Meal ID', '',['class'=>'form-control', 'placeholder' => 'Meal ID'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection