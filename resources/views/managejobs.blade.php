@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Manage Jobs')

@section('content')
<div class = "registerform">
	<table>
	
		<thead>
			<tr>
				<th>Position</th>
				<th>Company</th>
				<th>Location</th>
				<th>Requirements</th>
				<th>Level</th>
				<th>Description</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		
		<tbody>
			 @for ($i = 0; $i < count($jobs); $i++)
          <tr>
              <td> {{ $jobs[$i]['POSITION'] }} </td>
              <td> {{ $jobs[$i]['COMPANY'] }} </td>
              <td> {{ $jobs[$i]['LOCATION'] }} </td>
              <td> {{ $jobs[$i]['REQUIREMENTS'] }} </td>
              <td> {{ $jobs[$i]['LEVEL'] }} </td>
              <td> {{ $jobs[$i]['DESCRIPTION'] }} </td>
			  <td> <!-- Button to open the modal -->
                   <button onclick="document.getElementById('id01').style.display='block'">Edit</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="editJob" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Job</h1>
      <input type="hidden" name = "id" value = "{{ $jobs[$i]['ID'] }}">
      <hr>
      
      <label for="position"><b>Position</b></label>
      <input type="text" placeholder="Enter Position" name="position" value="{{ $jobs[$i]['POSITION'] }}">{{ $errors->first('position') }}
      
       <label for="position"><b>Company</b></label>
      <input type="text" placeholder="Enter Position" name="company" value="{{ $jobs[$i]['COMPANY'] }}">{{ $errors->first('company') }}
      
       <label for="position"><b>Location</b></label>
      <input type="text" placeholder="Enter Position" name="location" value="{{ $jobs[$i]['LOCATION'] }}">{{ $errors->first('location') }}   
      
       <label for="position"><b>Requirements</b></label>
      <input type="text" placeholder="Enter Position" name="requirements" value="{{ $jobs[$i]['REQUIREMENTS'] }}"> {{ $errors->first('requirements') }}   
      
       <label for="position"><b>Level</b></label>
      <input type="text" placeholder="Enter Position" name="level" value="{{ $jobs[$i]['LEVEL'] }}"> {{ $errors->first('level') }}   
      
       <label for="position"><b>Description</b></label>
      <input type="text" placeholder="Enter Position" name="description" value="{{ $jobs[$i]['DESCRIPTION'] }}">{{ $errors->first('description') }}

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>

<td> <!-- Button to open the modal -->
     <button onclick="document.getElementById('id02').style.display='block'">Delete</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="deleteJob" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete Job</h1>
      <input type="hidden" name = "ID" value = "{{ $jobs[$i]['ID'] }}">
      <hr>   
 	<p>Are you sure you want to delete?</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Delete</button>
      </div>
    </div>
  </form>
  </div>
</div>
</td>

</tr>
 @endfor
		</tbody>
	</table>

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
