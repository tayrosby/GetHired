<!DOCTYPE html>
@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Job Search Results')

@section('content')

<h1 class = "h1">Get Hired!</h1>

<div class="container-fluid">

@for($x = 0; $x < count($jobs); $x++)

			<form class = "loginform" action="searchDescription" method="GET">
            <input type = "hidden" name ="_token" value = "<?php echo csrf_token()?>"/>
            <hr>
            <!--  allows for user input and passes the info to the processor file -->
            
            <div class="form-group">
            <input type="text" name="descriptionSearch" maxlength="10" value="{{ $jobs[$x]['POSITION'] }}">{{ $errors->first('descriptionSearch') }}<br>
            </div>
              
             <input type = "submit" value = "Search"/><br>
             <hr>
             </form>
				
	@endfor

</div> 
@endsection
