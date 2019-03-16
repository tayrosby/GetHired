@php
use App\Services\Business\SkillsBusinessService;
use App\Services\Business\EducationBusinessService;
use App\Services\Business\ContactBusinessService;
use App\Services\Business\ExperienceBusinessService;
@endphp

@extends('layouts.maintemplate')
@section('title', 'Get Hired! | My Profile')

@php

$cbs = new ContactBusinessService();

$contact = $cbs->findAllContacts();

$sbs = new SkillsBusinessService();

$skills = $sbs->findAllSkills();

$edbs = new EducationBusinessService();

$education = $edbs->findAllEducation();

$exbs = new ExperienceBusinessService();

$experience = $exbs->findAllExperience();

@endphp

<style>
h4 {
	text-align:left;
}

body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #D3D3D3;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #EC340D;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>

@section('content')
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
          @for ($i = 0; $i < count($contact); $i++)
          <tr>
              <td> {{ $contact[$i]['PHONE_NUMBER'] }} </td>
              <td> {{ $contact[$i]['EMAIL_ADDRESS'] }} </td>
              <td> {{ $contact[$i]['CITY'] }} </td>
              <td> {{ $contact[$i]['STATE'] }} </td>

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
      <input type="hidden" name = "id" value = "{{ $contact[$i]['ID'] }}">
      
       <label for="position"><b>Contact</b></label>
      <input type="tel" placeholder="Enter Phone Number" name="phoneNumber"  value="{{ $contact[$i]['PHONE_NUMBER'] }} " required />{{ $errors->first('phoneNumber') }}
      <input type="text" placeholder="Enter Email Address" name="email" value="{{ $contact[$i]['EMAIL_ADDRESS'] }}" required />{{ $errors->first('email') }}
      <input type="text" placeholder="Enter City" name="city" value="{{ $contact[$i]['CITY'] }}" required />{{ $errors->first('city') }}
      <input type="text" placeholder="Enter State" name="state" value="{{ $contact[$i]['STATE'] }}" required />{{ $errors->first('state') }}
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id08').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>
              
          </tr>
         @endfor
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
          @for ($i = 0; $i < count($skills); $i++)
              <td> {{ $skills[$i]['SKILL_NAME'] }} </td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id01').style.display='block'">Add</button>    <!-- The Modal (contains the Sign Up form) -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_skill" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />

    <div class="container">
      <h1>Add Skill</h1>
      <hr>
      <input type="hidden" name = "user_id" value = "{{ $skills[$i]['USERS_ID'] }}">
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
      <input type="hidden" name = "id" value = "{{ $skills[$i]['ID'] }}">
      
       <label for="position"><b>Skill</b></label>
      <input type="text" placeholder="Enter Skill" name="skillName"  value="{{ $skills[$i]['SKILL_NAME'] }} " required>
      

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
      <input type="hidden" name = "id" value = "{{ $skills[$i]['ID'] }}">
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
         @endfor
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
          @for ($i = 0; $i < count($education); $i++)
          <tr>
              <td> {{ $education[$i]['SCHOOL_NAME'] }} </td>
              <td> {{ $education[$i]['DEGREE'] }} </td>
              <td> {{ $education[$i]['GRADUATION_YEAR'] }} </td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id03').style.display='block'">Add</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id03" class="modal">
  <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_edu" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
  <input type="hidden" name="user_id" value="{{ $education[$i]['USERS_ID'] }}" />
        
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
      <input type="hidden" name = "id" value = "{{$education[$i]['ID']}}">
      <hr>
      
      <label for="position"><b>School Name</b></label>
      <input type="text" placeholder="Enter School Name" name="schoolName" value="{{$education[$i]['SCHOOL_NAME']}}" required>

      <label for="company"><b>Degree</b></label>
      <input type="text" placeholder="Enter Degree" name="degree" value="{{$education[$i]['DEGREE']}}"required>

      <label for="Location"><b>Graduation Year</b></label>
      <input type="text" placeholder="Enter Graduation Year" name="graduationYear" value="{{$education[$i]['GRADUATION_YEAR']}}" required>      

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
      <input type="hidden" name = "id" value = "{{ $education[$i]['ID'] }}">
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
         @endfor
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
          @for ($i = 0; $i < count($experience); $i++)
          <tr>
              <td> {{ $experience[$i]['POSITION'] }} </td>
              <td> {{ $experience[$i]['COMPANY'] }} </td>
              <td> {{ $experience[$i]['LOCATION'] }} </td>
              <td> {{ $experience[$i]['YEARS_ACTIVE'] }} </td>
              <td> {{ $experience[$i]['DUTIES'] }} </td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id05').style.display='block'">Add</button>    <!-- The Modal (contains the Sign Up form) -->
<div id="id05" class="modal">
  <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_xp" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Add Experience</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $experience[$i]['USERS_ID'] }}">
      
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
      <input type="hidden" name = "id" value = "{{ $experience[$i]['ID'] }}">
      
      <label for="position"><b>Position</b></label>
      <input type="text" placeholder="Enter Position" name="position" value="{{ $experience[$i]['POSITION'] }}" required>

      <label for="company"><b>Company</b></label>
      <input type="text" placeholder="Enter Company" name="company" value="{{ $experience[$i]['COMPANY'] }}" required>

      <label for="Location"><b>Location</b></label>
      <input type="text" placeholder="Enter Location" name="location" value="{{ $experience[$i]['LOCATION'] }}" required>
      
      <label for="yearsActive"><b>Years Active</b></label>
      <input type="text" placeholder="Enter Years Active" name="yearsActive" value="{{ $experience[$i]['YEARS_ACTIVE'] }}" required>

      <label for="Location"><b>Duties</b></label>
      <input type="text" placeholder="Duties" name="duties" value="{{ $experience[$i]['DUTIES'] }}" required>
      

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
      <input type="hidden" name = "id" value = "{{ $experience[$i]['ID'] }}">
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
         @endfor
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
