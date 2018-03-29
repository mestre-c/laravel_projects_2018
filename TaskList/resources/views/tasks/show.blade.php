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
     <button class="btn btn-default" type="button">Edit</button>
    </a>

@endsection