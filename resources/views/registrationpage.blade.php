@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Register')

@section('content')
	<div class="container-fluid">
	<form class = "registerform" action="registrationpage" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
		
		<div align="center">
		<h2>Register</h2>
		<hr>
		<table>
			<tr>
				<td>First Name: </td>
				<td><input type="text" name="firstname"/>{{ $errors->first('firstname') }}</td>
			</tr>
			
			<tr>
				<td>Last Name: </td>
				<td><input type="text" name="lastname"/>{{ $errors->first('lastname') }}</td>
			</tr>
			
			<tr>
				<td>E-Mail: </td>
				<td><input type="text" name="email"/>{{ $errors->first('email') }}</td>
			</tr>
			
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username"/>{{ $errors->first('username') }}</td>
			</tr>
			
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password"/>{{ $errors->first('password') }}</td>
			</tr>
			
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Register"/>
				</td>
			</tr>
		</table>
		<hr>
		 <a href="login">Have an account. Log in here.</a>
		</div>
	</form>
	</div> 
@endsection

