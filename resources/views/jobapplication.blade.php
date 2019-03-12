@extends('layouts.maintemplate')
@section('title', 'Get Hired! | Job Search Results')

@section('content')

<h1 class = "h1">Get Hired!</h1>

<div class="container-fluid">
    
    <form class = "loginform" action="jobDetails" method="POST">
    <input type = "hidden" name ="_token" value = "<?php echo csrf_token()?>"/>
    
    <p>Congrats! Your application has been recieved.</p>

    </form>
    
    </div>
    @endsection
