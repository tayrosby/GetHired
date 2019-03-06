@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Add Groups')

@section('content')
<div class="container-fluid">
	<form class = "registerform" action="addgroup" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
		
		<div align="center">
		<h2>Add Groups</h2>
		<hr>
		<table>
		<tr>
			<td><input type="hidden" name = "userID" value = "13"><td>
			<tr>
			<tr>
				<td>Group Name: </td>
				<td><input type="text" name="groupName"/>{{ $errors->first('groupName') }}</td>
			</tr>
			
			<tr>
				<td>Interest </td>
				<td><input type="text" name="interest"/>{{ $errors->first('interest') }}</td>
			</tr>
			
			<tr>
				<td>Description </td>
				<td><textarea rows="4" cols="50" name="groupDescription">{{ $errors->first('groupDescription') }}</textarea></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Add Group"/>
				</td>
			</tr>
		</table>
		</div>
	</form>
	</div> 
@endsection
