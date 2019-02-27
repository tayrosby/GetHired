@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Manage Jobs')

@section('content')

			@foreach($jobs as $job)

					<!-- ForEach Loop -->
					@foreach($job as $value)
						<form class ="registerform" >
						{{ $value }}
						</form>
					@endforeach
					

			@endforeach


@endsection