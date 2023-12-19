<?php
include "partials/header.php";
include "partials/footer.php";
require_once "classes/Staff.php";


if (isset($_POST['btn_submit'])) {
	$staff_username = $_POST['username'];
	$staff_password = $_POST['password'];

	$staff = new Staff();
	$response = $staff->staff_login($staff_username, $staff_password);

}
?>


<div class="card col-md-8">
	<div class="card-body">
		<form method="post">
			<div class="form-group">
				<label for="username" class="control-label">Username</label>
				<input type="text" id="username" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label for="password" class="control-label">Password</label>
				<input type="password" id="password" name="password" class="form-control">
			</div>
			<input type="submit" class="btn btn-primary w-100" value="Submit" name="btn_submit">
		</form>
	</div>
</div>