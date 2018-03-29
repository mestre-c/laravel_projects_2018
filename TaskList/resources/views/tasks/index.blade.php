@extends('layouts.app');

@section('content')


<h1>Current Tasks</h1>
@if(count($tasks) > 0)
@foreach($tasks as $task)
<div class="card card-body bg-light">
    <h3><a href="task/{{$task->id}}">{{ $task->text }}</a> <span class="badge badge-danger">{{ $task->due }}</span></h3>

</div>
@endforeach
@endif
@endsection