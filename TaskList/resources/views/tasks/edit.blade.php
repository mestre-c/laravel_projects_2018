@extends('layouts.app')

@section('content')
<a href="/task/{{ $task->id}}">
   <button class="btn btn-default" type="button">Go Back</button>
</a>
  <h1>Edit Task</h1>
  {!! Form::open(['action' => ['TasksController@update', $task->id], 'method' => 'POST']) !!}
    {{ Form::bsText('text', $task->text) }} <!-- text is the name of the field in todolist database -->
    {{ Form::bsTextArea('body', $task->body) }} <!-- body is the name of the field in todolist database -->
    {{ Form::bsText('due', $task->due) }} <!-- due is the name of the field in todolist database -->
    {{ Form::hidden('_method', 'PUT') }} <!-- hidden cause there is no method PUT for forms -->
    {{ Form::bsSubmit('Submit', ['class' => 'btn btn-primary']) }} <!-- just a submit button -->
  {!! Form::close() !!}

@endsection
