<?php $__env->startSection('title', 'Get Hired! | Register'); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
	<form class = "registerform" action="registrationpage" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
		
		<div align="center">
		<h2>Register</h2>
		<hr>
		<table>
			<tr>
				<td>First Name: </td>
				<td><input type="text" name="firstname"/><?php echo e($errors->first('firstname')); ?></td>
			</tr>
			
			<tr>
				<td>Last Name: </td>
				<td><input type="text" name="lastname"/><?php echo e($errors->first('lastname')); ?></td>
			</tr>
			
			<tr>
				<td>E-Mail: </td>
				<td><input type="text" name="email"/><?php echo e($errors->first('email')); ?></td>
			</tr>
			
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username"/><?php echo e($errors->first('username')); ?></td>
			</tr>
			
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password"/><?php echo e($errors->first('password')); ?></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Register"/>
				</td>
			</tr>
		</table>
		<hr>
		 <a href="login">Have an account. Log in here.</a>
		</div>
	</form>
	</div> 
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.maintemplate', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>