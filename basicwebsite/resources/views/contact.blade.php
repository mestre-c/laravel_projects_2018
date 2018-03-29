@extends('layouts.app')

@section('content')
  <h1>Contact Page</h1>
  {!! Form::open(['url' => 'contact/submit']) !!}
     <div class="form-group">
       {{ Form::label('name', 'Name') }}
       {{ Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Enter name']) }}
     </div>
     <div class="form-group">
         {{ Form::label('email', 'E-Mail Address') }}
         {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
     </div>
     <div class="form-group">
       {{ Form::label('message', '') }}
       {{ Form::textarea('message', '',  ['class' => 'form-control', 'placeholder' => 'Enter message']) }}
     </div>
     <div class="">
       {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
     </div>
  {!! Form::close() !!}
@endsection
