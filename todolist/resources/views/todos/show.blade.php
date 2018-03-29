@extends('layouts.app')

@section('content')
<!-- <a class="btn btn-default" href="/">Go Back</a> -->
<a href="/">
  <button class="btn btn-default" type="button">Go Back</button>
</a>
  <!-- <h1>{{ $todo->text }}</h1> -->
  <h1><a href="todo/{{$todo->id}}">{{ $todo->text }}</a></h1>
  <div class="badge badge-danger">{{ $todo->due }}</div>
  <hr />
  <p>{{ $todo->body }}</p>
  <br /><br />
    <a href="/todo/{{ $todo->id }}/edit">
     <button class="btn btn-default" type="button">Edit</button>
    </a>
    {!! Form::open(['action' => [ 'TodosController@destroy', $todo->id ], 'method' => 'POST', 'class' => 'float-right']) !!}
    {{ Form::hidden('_method','DELETE') }}
      {{ Form::bsSubmit('Delete', ['class' => 'btn btn-danger']) }} <!-- just a submit button -->
    {!! Form::close() !!}
@endsection
