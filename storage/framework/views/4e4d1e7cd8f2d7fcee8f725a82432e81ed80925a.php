<?php $__env->startSection('title', 'Get Hired! | Add Jobs'); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
	<form class = "loginform" action="addjobs" method="POST">
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
		
		<div align="center">
		<h2>Add Jobs</h2>
		<hr>
		<table>
			<tr>
				<td>Job Position: </td>
				<td><input type="text" name="position"/><?php echo e($errors->first('position')); ?></td>
			</tr>
			
			<tr>
				<td>Company: </td>
				<td><input type="text" name="company"/><?php echo e($errors->first('company')); ?></td>
			</tr>
			
			<tr>
				<td>Location: </td>
				<td><input type="text" name="location"/><?php echo e($errors->first('location')); ?></td>
			</tr>
			
			<tr>
				<td>Requirements: </td>
				<td><input type="text" name="requirements"/><?php echo e($errors->first('requirements')); ?></td>
			</tr>
			
			<tr>
				<td>Level: </td>
				<td><input type="text" name="level"/><?php echo e($errors->first('level')); ?></td>
			</tr>
			
			<tr>
				<td>Description: </td>
				<td><input type="text" name="description"/><?php echo e($errors->first('description')); ?></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Add Job"/>
				</td>
			</tr>
		</table>
		</div>
	</form>
	</div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.maintemplate', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>