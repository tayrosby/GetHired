<!DOCTYPE html>
@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Login')

@section('content')


<h1 class = "h1">Get Hired!</h1>

<div class="container-fluid">
<form class = "loginform" action="loginpage" method="POST">
<input type = "hidden" name ="_token" value = "<?php echo csrf_token()?>"/>
<h2>Log In</h2>
<hr>
<!--  allows for user input and passes the info to the processor file -->

<div class="form-group">
<input type="text" placeholder= "Username" name="username" maxlength="10">{{ $errors->first('username') }}<br>
</div>

<div class="form-group">
<input type="password" placeholder= "Password" name="password"maxlength="10">{{ $errors->first('password') }}<br>
</div>
  
 <input type = "submit" value = "Log In"/><br>
 <hr>
 <a href="register">Don't have an account. Sign up here.</a>
 </form>
</div> 
@endsection
