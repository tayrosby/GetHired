@php
use App\Services\Business\GroupBusinessService;
@endphp

@extends('layouts.maintemplate')
@section('title', 'Get Hired! | My Profile')

@php

$gbs = new GroupBusinessService();

$group = $gbs->findAllGroups();

@endphp

@section('content')

<table class = "registerform">
 <thead>
    <h4>Manage Groups</h4>
        <tr>
            <th> Name</th>
        </tr>
    </thead>
    <tbody>
          @for ($i = 0; $i < count($group); $i++)
          <tr>
              <td> {{ $group[$i]['GROUP_NAME'] }} </td>
              
                <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id02').style.display='block'">Edit Group</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="editGroup" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Group</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $group[$i]['ID'] }}">
      
       <label for="position"><b>Group Name</b></label>
      <input type="text" placeholder="Enter Group Name" name="groupName"  value="{{ $group[$i]['GROUP_NAME'] }} " required>
      <input type="text" placeholder="Enter Group Description" name="groupDescription"  value="{{ $group[$i]['GROUP_DESCRIPTION'] }} " required>
      <input type="text" placeholder="Enter Interest" name="interest"  value="{{ $group[$i]['INTEREST'] }} " required>
      

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signup">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>

<td>
<button onclick="document.getElementById('id07').style.display='block'">Delete Group</button>
<div id="id07" class="modal">
  <span onclick="document.getElementById('id07').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="deleteGroup" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete Group</h1>
      <input type="hidden" name = "id" value = "{{ $group[$i]['ID'] }}">
      <hr>   
 	<p>Are you sure you want to delete?</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id07').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signup">Delete</button>
      </div>
    </div>
  </form>
</div>
</td>
          </tr>
         @endfor
                 </tbody>
</table>
@endsection
