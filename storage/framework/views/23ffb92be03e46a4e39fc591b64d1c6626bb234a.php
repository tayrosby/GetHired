<!DOCTYPE html>

<?php $__env->startSection('title', 'Get Hired! | Login'); ?>

<?php $__env->startSection('content'); ?>


<h1 class = "h1">Get Hired!</h1>

<div class="container-fluid">
<form class = "loginform" action="loginpage" method="GET">
<input type = "hidden" name ="_token" value = "<?php echo csrf_token()?>"/>
<h2>Log In</h2>
<hr>
<!--  allows for user input and passes the info to the processor file -->

<div class="form-group">
<input type="text" placeholder= "Username" name="username" maxlength="10"><?php echo e($errors->first('username')); ?><br>
</div>

<div class="form-group">
<input type="password" placeholder= "Password" name="password"maxlength="10"><?php echo e($errors->first('password')); ?><br>
</div>
  
 <input type = "submit" value = "Log In"/><br>
 <hr>
 <a href="register">Don't have an account. Sign up here.</a>
 </form>
</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.maintemplate', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>