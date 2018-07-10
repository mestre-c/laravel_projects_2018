<!DOCTYPE html>
<html>
 <head>
  <title>Laravel Backup</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>
 <body>
  <br />
  <div class="container">
   <div class="row">
    <h2 align="center">Database Backup using PHP and MySQL</h2>
    <br />
    <form method="POST" action="{{route('backup')}}" id="export_form">
      {{ csrf_field() }}

     <h3>Select Tables for Backup</h3>
     <h4>Tables Info</h4>
     <!-- <h4>Number of Tables: {{ count($numTables) }}</h4> -->
     <ul>
      <li>{{ count($numTables) }} tables affected!</li>
      <li>User table:{{ $countUserRecords }} records</li>
      <li>Post table:{{ $countPostRecords }} records</li>
     </ul>
      
    
    @foreach($numTables as $table)
     <div class="checkbox">
      <label>
        <input type="checkbox" class="checkbox_table" name="table[]" 
        value="{{ $table['Tables_in_backup'] }}" /> 
        {{ $table['Tables_in_backup'] }}
      </label>
     </div>
    @endforeach 
    
     <div class="form-group">
      <input type="submit" name="submit" id="submit" class="btn btn-info" value="Backup" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>
<script src="{{ asset('js/backup.js') }}"></script>
<!-- <script src="{{ URL::to('src/js/app.js')}}"></script> -->

