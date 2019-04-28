@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Admin')

@section('content')

<div class = "registerform">
	<table>
	
		<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Username</th>
				<th>Password</th>
				<th>Role</th>
				<th>Profile</th>
				<th>Suspend</th>
				<th>Delete</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($users as $user)
				<tr>
					<!-- ForEach Loop -->
					@foreach($user as $value)
						<td>{{ $value }}</td>
					@endforeach
					<!-- Suspend Form -->
					<form class="adminform" id="suspend{{$user['ID']}}" action="suspendUser" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="hidden" name="ID" value="{{$user['ID']}}"/>
					</form>
			<!-- Profile Form -->
					<form class="adminform" id="profile{{$user['ID']}}" action="profileAdmin" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}" />
						<input type="hidden" name="ID" value="{{$user['ID']}}" />
					</form>
					<!-- Profile Button -->
					<td><input form="profile{{$user['ID']}}" class="btn" type="submit" value="Profile"/></td>
					<!-- Suspend Button -->
					<td><input form="suspend{{$user['ID']}}" class="btn" type="submit" value="Suspend User"/></td>
					<td>
<button onclick="document.getElementById('id07').style.display='block'">Delete</button>
<div id="id07" class="modal">
  <span onclick="document.getElementById('id07').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="deleteUser" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete User</h1>
      <input type="hidden" name = "ID" value = "{{$user['ID']}}">
      <hr>   
 	<p>Are you sure you want to delete?</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id07').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Delete</button>
      </div>
    </div>
  </form>
</div>
</td>
					
				</tr>
			@endforeach
		</tbody>
		
	</table>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

@endsection
