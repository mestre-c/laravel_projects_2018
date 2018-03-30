@extends('layouts.app');

@section('content')

<a href="/">
	<button class="btn btn-default" type="button">Go Back</button>
</a>
<h1><a href="task/{{$task->id}}">{{ $task->text }}</a></h1>
  <div class="badge badge-danger" style="font-size: 15px;">{{ $task->due }}</div>
  <hr />
  <p style="font-size: 20px;">{{ $task->body }}</p>
  <br /><br />
    <a href="/task/{{ $task->id }}/edit">
     <button class="btn btn-info" type="button">Edit</button>
    </a>
    {!! Form::open(['action' => [ 'TasksController@destroy', $task->id ], 'method' => 'POST', 'class' => 'float-right']) !!}
    {{ Form::hidden('_method','DELETE') }}
    {{ Form::bsSubmit('Delete', ['class' => 'btn btn-danger']) }} <!-- just a submit button -->
    {!! Form::close() !!}
@endsection