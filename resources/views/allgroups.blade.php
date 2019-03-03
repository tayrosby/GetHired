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
    <h4>Groups</h4>
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
						<input type="hidden" name="userID" value="{{$group[$i]['USERS_ID']}}"/>
						
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
                    
                    </tr>
                        
                        <form id="leaveGroup{{$group[$i]['ID']}}" action="deletemember" method="POST">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<input type="hidden" name="groupID" value="{{$group[$i]['ID']}}"/>
						<input type="hidden" name="userID" value="{{$group[$i]['USERS_ID']}}"/>
			</form>
			
			<td><input form="leaveGroup{{$group[$i]['ID']}}" class="btn" type="submit" value="Leave Group"/></td>
         @endfor
         
   </tbody>
</table>
@endsection
