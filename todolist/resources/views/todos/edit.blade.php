@extends('layouts.app')

@section('content')
<a href="/todo/{{ $todo->id}}">
   <button class="btn btn-default" type="button">Go Back</button>
</a>
  <h1>Edit Todo</h1>
  {!! Form::open(['action' => ['TodosController@update', $todo->id], 'method' => 'POST']) !!}
    {{ Form::bsText('text', $todo->text) }} <!-- text is the name of the field in todolist database -->
    {{ Form::bsTextArea('body', $todo->body) }} <!-- body is the name of the field in todolist database -->
    {{ Form::bsText('due', $todo->due) }} <!-- due is the name of the field in todolist database -->
    {{ Form::hidden('_method', 'PUT') }} <!-- hidden cause there is no method PUT for forms -->
    {{ Form::bsSubmit('Submit', ['class' => 'btn btn-primary']) }} <!-- just a submit button -->
  {!! Form::close() !!}

@endsection
