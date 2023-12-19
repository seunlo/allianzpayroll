<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="fa/css/all.css">
	<title>Vertical Sidebar</title>
	<style>
		body {
			font-family: 'Arial', sans-serif;
		}

		#sidebar {
			height: 100vh;
			width: 250px;
			position: fixed;
			top: 56px;
			left: 0;
			background-color: #343a40;
			/* Bootstrap dark background color */
			padding-top: 20px;
		}

		#navbar {
			z-index: 1;
		}

		#content {
			margin-left: 250px;
			/* Adjust this value based on the width of your sidebar */
			padding: 20px;
		}
	</style>
</head>

<body>


	<div id="sidebar">
		<ul>
			<li>
				<a href="index.php" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
							class="fa fa-home text-light"></i></span>
					Home</a>
			</li>
			<li class="my-4">
				<a href="navbar.php?attendance" class="nav-item text-decoration-none text-light"><span class='icon-field'><i
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
		</ul>
	</div>

	<div id="content" class="bg-secondary text-light">
		<p>Welcome Back Admin!</p>
	</div>

	<?php if (isset($_GET['attendance'])) {
		include "../attendance.php";
	} ?>