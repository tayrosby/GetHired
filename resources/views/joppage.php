@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Manage Jobs')

@section('content')

@for($x = 0; $x < count($jobs); $x++)

<div class="container-fluid">
<form class = "registerform">
		
<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
					
 <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" name="position" value="{{ $jobs[$x]['POSITION'] }}">
    </div>
    <div class="form-group col-md-6">
      <input type="text" name="company" value="{{ $jobs[$x]['COMPANY'] }}">
    </div>
  </div>
  <div class="form-group">
    <input type="text" name="location" value="{{ $jobs[$x]['LOCATION'] }}">
  </div>
  <div class="form-group">
    <input type="text" name="description" value="{{ $jobs[$x]['DESCRIPTION'] }}">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input  type="text" name="level" value="{{ $jobs[$x]['LEVEL'] }}">
    </div>
    <div class="form-group col-md-2">
      <label>Requirements</label>
      <input type="text" name="requirements" value="{{ $jobs[$x]['REQUIREMENTS'] }}">
    </div>
    </div>
</form>

</div>

@endfor
@endsection
