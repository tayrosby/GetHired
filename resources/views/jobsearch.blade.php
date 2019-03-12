<!DOCTYPE html>
@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Job Search')

@section('content')


<h1 class = "h1">Get Hired!</h1>

<div class="container-fluid">
<form class = "loginform" action="searchDescription" method="POST">
<input type = "hidden" name ="_token" value = "<?php echo csrf_token()?>"/>
<h2>Search</h2>
<hr>
<!--  allows for user input and passes the info to the processor file -->

<div class="form-group">
<input type="text" placeholder= "Search" name="descriptionSearch" maxlength="10">{{ $errors->first('descriptionSearch') }}<br>
</div>
  
 <input type = "submit" value = "Search"/><br>
 <hr>
 </form>
</div> 
@endsection
