@extends('layouts.app')

@section('content')
	<h1>Create Category</h1>
    {!! Form::open(['route' =>'test', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title', '',['class'=>'form-control', 'placeholder' => 'Title'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection