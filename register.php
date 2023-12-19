<?php
include "partials/header.php";
include "partials/footer.php";
require_once "classes/Staff.php";

if(isset($_POST['btn_submit'])){
  $staff_name = $_POST['staffname'];
  $staff_email = $_POST['staffemail'];
  $staff_phone = $_POST['staffphone'];
  $staff_username = $_POST['staffusername'];
  $staff_password = $_POST['password'];

  $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

  $staff = new Staff();
  $response = $staff->create_staff($staff_name, $staff_email, $staff_phone, $staff_username, $hashed_password);
  if ($response) {
    echo "<script>alert('Staff Registered successfully');
    window.location.href = '../login.php';      
    </script>";
    
  }
}
?>

<div class="card col-md-8">
  				<div class="card-body">
  						
  					<form method="post" >
  						<div class="form-group">
  							<label for="staffname" class="control-label">Staff Name</label>
  							<input type="text" id="username" name="staffname" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="staffemail" class="control-label">Email</label>
  							<input type="email" id="username" name="staffemail" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="staffphone" class="control-label">Phone</label>
  							<input type="number" id="username" name="staffphone" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="staffusername" class="control-label">Username</label>
  							<input type="text" id="username" name="staffusername" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<input type="submit" class="btn btn-primary w-100" value="Register" name="btn_submit">
  					</form>
  				</div>
  			</div>