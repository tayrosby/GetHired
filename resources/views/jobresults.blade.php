<!DOCTYPE html>
@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Job Search Results')

@section('content')

<h1 class = "h1">Get Hired!</h1>

<div class="container-fluid">

@for($x = 0; $x < count($jobs); $x++)

			<form class = "loginform" action="jobDetails" method="POST">
            <input type = "hidden" name ="_token" value = "<?php echo csrf_token()?>"/>
            <hr>
            <!--  allows for user input and passes the info to the processor file -->
            
            <div class="form-group">
            
            <input type="hidden" name = "id" value = "{{ $jobs[$x]['ID'] }}">
            
            <button type = 'submit' class='btn btn-link'>{{ $jobs[$x]['POSITION'] }}</button><br>
            <input type="text" value="{{ $jobs[$x]['COMPANY'] }}"><br>
            <input type="text" value="{{ $jobs[$x]['LOCATION'] }}"><br>
            </div>
             <hr>
             </form>
				
	@endfor

</div> 
@endsection
