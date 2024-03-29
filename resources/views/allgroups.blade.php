@php
use App\Services\Business\GroupBusinessService;
@endphp

@extends('layouts.maintemplate')
@section('title', 'Get Hired! | My Profile')

@php

$gbs = new GroupBusinessService();

$group = $gbs->findAllGroups();

$groupMembers = $gbs->findAllGroupMembers();


@endphp

@section('content')

<table class = "registerform">
 <thead>
    <h1>Groups</h1>
        <tr>
            <th> Name</th>
            <th> Interest</th>
            <th> Description</th>
        </tr>
    </thead>
    <tbody>
          @for ($i = 0; $i < count($group); $i++)
          <tr>
              <td> {{ $group[$i]['GROUP_NAME'] }} </td>
              <td> {{ $group[$i]['INTEREST'] }} </td>
              <td> {{ $group[$i]['GROUP_DESCRIPTION'] }} </td>

              <form id="joinGroup{{$group[$i]['ID']}}" action="addmember" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="hidden" name="groupID" value="{{$group[$i]['ID']}}"/>
						<input type="hidden" name="userID" value="{{ session()->get('userID') }}"/>
						
                        <br>
						<td>
                        <br>
					    @for ($j = 0; $j < count($groupMembers); $j++)
							{{ $groupMembers[$j]['FIRSTNAME'] }}
							{{ $groupMembers[$j]['LASTNAME'] }}
						@endfor
						 </td>
			</form>
			
					<td><input form="joinGroup{{$group[$i]['ID']}}" class="btn" type="submit" value="Join Group"/></td>
    
	
               <form id="leaveGroup{{$group[$i]['ID']}}" action="deletemember" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="hidden" name="groupID" value="{{$group[$i]['ID']}}"/>
						<input type="hidden" name="userID" value="{{ session()->get('userID') }}"/>
			</form>
            
			<td><input form="leaveGroup{{$group[$i]['ID']}}" class="btn" type="submit" value="Leave Group"/></td>
            
             </tr>
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
        <button type="submit" class="signupbtn">Edit</button>
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
        <button type="submit" class="signupbtn">Delete</button>
      </div>
    </div>
  </form>
</div>
</td>
         @endfor
         
   </tbody>
</table>
@endsection
