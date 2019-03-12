@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Job Details')

@section('content')
	<div class="container-fluid">
	<form class = "loginform" action="jobApp" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
		
		<div align="center">
		<h2>Job Details</h2>
		<hr>
		<table>
			<tr>
				<td>Job Position: </td>
				<td><input type="text" name="position"/>{{ $errors->first('position') }}</td>
			</tr>
			
			<tr>
				<td>Company: </td>
				<td><input type="text" name="company"/>{{ $errors->first('company') }}</td>
			</tr>
			
			<tr>
				<td>Location: </td>
				<td><input type="text" name="location"/>{{ $errors->first('location') }}</td>
			</tr>
			
			<tr>
				<td>Requirements: </td>
				<td><input type="text" name="requirements"/>{{ $errors->first('requirements') }}</td>
			</tr>
			
			<tr>
				<td>Level: </td>
				<td><input type="text" name="level"/>{{ $errors->first('level') }}</td>
			</tr>
			
			<tr>
				<td>Description: </td>
				<td><input type="text" name="description"/>{{ $errors->first('description') }}</td>
			</tr>
			
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Apply"/>
				</td>
			</tr>
		</table>
		</div>
	</form>
	</div> 
@endsection
