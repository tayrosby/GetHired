<?php $__env->startSection('title', 'Get Hired! | Admin'); ?>

<style>
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
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
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
@media  screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>

<?php $__env->startSection('content'); ?>

<div>
	<table>
	
		<thead>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Username</th>
				<th>Password</th>
				<th>Role</th>
				<th>Profile</th>
				<th>Suspend</th>
				<th>Delete</th>
			</tr>
		</thead>
		
		<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<!-- ForEach Loop -->
					<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<td><?php echo e($value); ?></td>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<!-- Suspend Form -->
					<form class="adminform" id="suspend<?php echo e($user['ID']); ?>" action="suspendUser" method="POST">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
						<input type="hidden" name="ID" value="<?php echo e($user['ID']); ?>"/>
					</form>
			<!-- Profile Form -->
					<form class="adminform" id="profile<?php echo e($user['ID']); ?>" action="profileAdmin" method="POST">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
						<input type="hidden" name="ID" value="<?php echo e($user['ID']); ?>" />
					</form>
					<!-- Profile Button -->
					<td><input form="profile<?php echo e($user['ID']); ?>" class="btn" type="submit" value="Profile"/></td>
					<!-- Suspend Button -->
					<td><input form="suspend<?php echo e($user['ID']); ?>" class="btn" type="submit" value="Suspend User"/></td>
					<td>
<button onclick="document.getElementById('id07').style.display='block'">Delete</button>
<div id="id07" class="modal">
  <span onclick="document.getElementById('id07').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="deleteUser" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete User</h1>
      <input type="hidden" name = "ID" value = "<?php echo e($user['ID']); ?>">
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
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.maintemplate', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>