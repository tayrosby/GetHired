@extends('layouts.maintemplate')
@section('title', 'Get Hired! | My Profile')

@section('content')

@for ($i = 0; $i < count($profile); $i++)

{{ $profile['user']['firstName'] }}
{{ $profile['user']['lastName'] }}

<div class = "registerform">
<table bgcolor="#A9A9A9">
    <thead>
    <h4>Contact</h4>
        <tr>
            <th> Phone Number</th>
            <th> Email Address</th>
            <th> City</th>
            <th> State</th>
        </tr>
    </thead>
    <tbody>
          <tr>
              <td> {{ $profile['contact']['phoneNumber'] }} </td>
              <td> {{ $profile[$i]['EMAIL_ADDRESS'] }} </td>
              <td> {{ $profile[$i]['CITY'] }} </td>
              <td> {{ $profile[$i]['STATE'] }} </td>

              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id08').style.display='block'">Edit</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id08" class="modal">
  <span onclick="document.getElementById('id08').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="edit_contact" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Contact</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['ID'] }}">
      
       <label for="position"><b>Contact</b></label>
      <input type="tel" placeholder="Enter Phone Number" name="phoneNumber"  value="{{ $profile[$i]['contact']['PHONE_NUMBER'] }} " required />{{ $errors->first('phoneNumber') }}
      <input type="text" placeholder="Enter Email Address" name="email" value="{{ $profile[$i]['contact']['EMAIL_ADDRESS'] }}" required />{{ $errors->first('email') }}
      <input type="text" placeholder="Enter City" name="city" value="{{ $profile[$i]['contact']['CITY'] }}" required />{{ $errors->first('city') }}
      <input type="text" placeholder="Enter State" name="state" value="{{ $profile[$i]['contact']['STATE'] }}" required />{{ $errors->first('state') }}
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id08').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>
              
          </tr>
   </tbody>
</table>

<table>
    <thead>
    <h4>Skills</h4>
    </thead>
    <tbody>
 <tr>
            <th> Skill</th>
        </tr>
              <td> {{ $profile[$i]['SKILL_NAME'] }} </td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id01').style.display='block'">Add</button>    <!-- The Modal (contains the Sign Up form) -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_skill" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />

    <div class="container">
      <h1>Add Skill</h1>
      <hr>
      <input type="hidden" name = "user_id" value = "{{ $profile[$i]['USERS_ID'] }}">
      <label for="position"><b>Skill</b></label>
      <input type="text" placeholder="Enter Skill" name="skillName" required>
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Add</button>
      </div>
    </div>
  </form>
</div>
</td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id02').style.display='block'">Edit</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="edit_skill" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Skill</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['ID'] }}">
      
       <label for="position"><b>Skill</b></label>
      <input type="text" placeholder="Enter Skill" name="skillName"  value="{{ $profile[$i]['SKILL_NAME'] }} " required>
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>

<td>
<button onclick="document.getElementById('id07').style.display='block'">Delete</button>
<div id="id07" class="modal">
  <span onclick="document.getElementById('id07').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="delete_skill" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete Skill</h1>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['ID'] }}">
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
   </tbody>
</table>

<table bgcolor="#A9A9A9">
    <thead>
    <h4>Education</h4>
        <tr>
            <th> School Name</th>
            <th> Degree</th>
            <th> Graduation Year</th>
        </tr>
    </thead>
    <tbody>
          <tr>
              <td> {{ $profile[$i]['SCHOOL_NAME'] }} </td>
              <td> {{ $profile[$i]['DEGREE'] }} </td>
              <td> {{ $profile[$i]['GRADUATION_YEAR'] }} </td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id03').style.display='block'">Add</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id03" class="modal">
  <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_edu" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
  <input type="hidden" name="user_id" value="{{ $profile[$i]['USERS_ID'] }}" />
        
    <div class="container">
      <h1>Add Education</h1>
      <hr>
      
      <label for="position"><b>School Name</b></label>
      <input type="text" placeholder="Enter School Name" name="schoolName" required>

      <label for="company"><b>Degree</b></label>
      <input type="text" placeholder="Enter Degree" name="degree" required>

      <label for="Location"><b>Graduation Year</b></label>
      <input type="text" placeholder="Enter Graduation Year" name="graduationYear" required>      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Add</button>
      </div>
    </div>
  </form>
</div>
</td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id04').style.display='block'">Edit</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id04" class="modal">
  <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="edit_edu" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Education</h1>
      <input type="hidden" name = "id" value = "{{$profile[$i]['ID']}}">
      <hr>
      
      <label for="position"><b>School Name</b></label>
      <input type="text" placeholder="Enter School Name" name="schoolName" value="{{$profile[$i]['SCHOOL_NAME']}}" required>

      <label for="company"><b>Degree</b></label>
      <input type="text" placeholder="Enter Degree" name="degree" value="{{$profile[$i]['DEGREE']}}"required>

      <label for="Location"><b>Graduation Year</b></label>
      <input type="text" placeholder="Enter Graduation Year" name="graduationYear" value="{{$profile[$i]['GRADUATION_YEAR']}}" required>      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>

<td>
<button onclick="document.getElementById('id10').style.display='block'">Delete</button>
<div id="id10" class="modal">
  <span onclick="document.getElementById('id10').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="delete_edu" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete Education</h1>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['ID'] }}">
      <hr>   
 	<p>Are you sure you want to delete?</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id10').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Delete</button>
      </div>
    </div>
  </form>
</div>
</td>
          </tr>
   </tbody>
</table>

<table>
    <thead>
    <h4>Experience</h4>
        <tr>
            <th> Position</th>
            <th> Company</th>
            <th> Location</th>
            <th> Years Active</th>
            <th> Duties</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
          <tr>
              <td> {{ $profile[$i]['POSITION'] }} </td>
              <td> {{ $profile[$i]['COMPANY'] }} </td>
              <td> {{ $profile[$i]['LOCATION'] }} </td>
              <td> {{ $profile[$i]['YEARS_ACTIVE'] }} </td>
              <td> {{ $profile[$i]['DUTIES'] }} </td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id05').style.display='block'">Add</button>    <!-- The Modal (contains the Sign Up form) -->
<div id="id05" class="modal">
  <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_xp" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Add Experience</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['USERS_ID'] }}">
      
      <label for="position"><b>Position</b></label>
      <input type="text" placeholder="Enter Position" name="position" required>

      <label for="company"><b>Company</b></label>
      <input type="text" placeholder="Enter Company" name="company" required>

      <label for="Location"><b>Location</b></label>
      <input type="text" placeholder="Enter Location" name="location" required>
      
      <label for="yearsActive"><b>Years Active</b></label>
      <input type="text" placeholder="Enter Years Active" name="yearsActive" required>

      <label for="Location"><b>Duties</b></label>
      <input type="text" placeholder="Duties" name="duties1" required>
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id05').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Add</button>
      </div>
    </div>
  </form>
</div>
</td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id06').style.display='block'">Edit</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id06" class="modal">
  <span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="edit_xp" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Experience</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['ID'] }}">
      
      <label for="position"><b>Position</b></label>
      <input type="text" placeholder="Enter Position" name="position" value="{{ $profile[$i]['POSITION'] }}" required>

      <label for="company"><b>Company</b></label>
      <input type="text" placeholder="Enter Company" name="company" value="{{ $profile[$i]['COMPANY'] }}" required>

      <label for="Location"><b>Location</b></label>
      <input type="text" placeholder="Enter Location" name="location" value="{{ $profile[$i]['LOCATION'] }}" required>
      
      <label for="yearsActive"><b>Years Active</b></label>
      <input type="text" placeholder="Enter Years Active" name="yearsActive" value="{{ $profile[$i]['YEARS_ACTIVE'] }}" required>

      <label for="Location"><b>Duties</b></label>
      <input type="text" placeholder="Duties" name="duties" value="{{ $profile[$i]['DUTIES'] }}" required>
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id06').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>

<td>
<button onclick="document.getElementById('id09').style.display='block'">Delete</button>
<div id="id09" class="modal">
  <span onclick="document.getElementById('id09').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="delete_xp" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete Experience</h1>
      <input type="hidden" name = "id" value = "{{ $profile[$i]['ID'] }}">
      <hr>   
 	<p>Are you sure you want to delete?</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id09').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Delete</button>
      </div>
    </div>
  </form>
</div>
</td>
          </tr>
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

@endfor
@endsection
