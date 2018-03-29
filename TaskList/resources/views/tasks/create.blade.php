@extends('layouts.app')

@section('content')
  <h1>Create Task</h1>
  {!! Form::open(['action' => 'TasksController@store', 'method' => 'POST']) !!}
    {{ Form::bsText('text') }} <!-- text is the name of the field in todolist database -->
    {{ Form::bsTextArea('body') }} <!-- body is the name of the field in todolist database -->
    {{ Form::bsText('due') }} <!-- due is the name of the field in todolist database -->
    {{ Form::bsSubmit('Submit', ['class' => 'btn btn-primary']) }} <!-- just a submit button -->
  {!! Form::close() !!}

@endsection
