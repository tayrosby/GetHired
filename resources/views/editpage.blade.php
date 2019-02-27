@extends('layouts.maintemplate')
@section('title', 'GetHired! | Edit User')

@section('content')

<form class="loginform" action="edit" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	<input type="hidden" name="ID" value="{{$user['ID']}}"/>
	First Name: <br/>
	<input type="text" name="firstname" value="{{ $user['FIRSTNAME'] }}"/><br/>
	Last Name: <br/>
	<input type="text" name="lastname" value="{{ $user['LASTNAME'] }}"/><br/>
	Email: <br/>
	<input type="email" name="email" value="{{ $user['EMAIL'] }}"/><br/>
	Username: <br/>
	<input type="text" name="username" value="{{ $user['USERNAME'] }}"/><br/>
	Password: <br/>
	<input type="text" name="password" value="{{ $user['PASSWORD'] }}"/><br/>
	Role: <br/>
	<input type="text" name="role" value="{{ $user['ROLE'] }}"/><br/>
 	
	<input type="submit" name="Submit Edit"/>
</form>
@endsection