<?php
include "partials/header.php";
//include "partials/navbar.php";


?>


<div id="sidebar">
	<ul>
		<li>
			<a href="index.php?home" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-home text-light"></i></span>
				Home</a>
		</li>
		<li class="my-4">
			<a href="index.php?attendance" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-th-list"></i></span> Attendance</a>
		</li>
		<li>
			<a href="index.php?payroll" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-columns"></i></span> Payroll List</a>
		</li>
		<li class="my-4">
			<a href="index.php?employee" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-user-tie"></i></span> Employee List</a>
		</li>
		<li>
			<a href="index.php?department" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-columns"></i></span> Depatment List</a>
		</li>
		<li class="my-4">
			<a href="index.php?position" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-user-tie"></i></span> Position List</a>
		</li>
		<li>
			<a href="index.php?allowances" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-list"></i></span> Allowance List</a>
		</li>
		<li class="my-4">
			<a href="index.php?deductions" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-money-bill-wave"></i></span> Deduction List</a>
		</li>
		<li class="my-4">
			<a href="index.php?tracker" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
						class="fa fa-th-list"></i></span> Tracker</a>
		</li>
	</ul>
</div>

<div id="content">
	<?php
	if (isset($_GET['home'])) {
		include "home.php";
	}
	?>
	<?php
	if (isset($_GET['attendance'])) {
		include "attendance.php";
	}
	?>
	<?php
	if (isset($_GET['payroll'])) {
		include "payroll.php";
	}
	?>

	<?php
	if (isset($_GET['employee'])) {
		include "employee.php";
	}
	?>

	<?php
	if (isset($_GET['department'])) {
		include "department.php";
	}
	?>

	<?php
	if (isset($_GET['position'])) {
		include "position.php";
	}
	?>

	<?php
	if (isset($_GET['allowances'])) {
		include "allowances.php";
	}
	?>

	<?php
	if (isset($_GET['deductions'])) {
		include "deductions.php";
	}
	?>
	<?php
	if (isset($_GET['tracker'])) {
		include "tracker.php";
	}
	?>
	<?php
	if (isset($_GET['details'])) {
		include "details.php";
	}
	?>
</div>
<?php include "partials/footer.php"; ?>