<?php
require_once "./classes/Staff.php";

if (isset($_POST['logout_btn'])) {
  $emp_no = $_POST['logout'];



  if (empty($emp_no)) {

    echo "All fields are required";
    
   
  }

  $staff_log = new Staff();
  $staff->staff_logout($emp_no);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="fa/css/all.css">
  <link rel="stylesheet" href="bootstrap/css/jquery.dataTables.min.css">
  <title>Document</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    .footer {
      position: fixed;
      bottom: 0;
      z-index: 2;
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

  <nav class="navbar navbar-expand-lg bg-primary" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand text-light fw-bolder ms-5" href="index.php">Payroll Management System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" data-bs-toggle="modal" data-bs-target="#mywork"
              href="./signout.php"><i class="fa fa-power-off"></i>Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="mywork" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="fw-bold" id="exampleModalLabel">Enter Employee No to Logout</h3>
        </div>
        <div class="modal-body">
          <div class='container'>
            <div class='row justify-content-center my-5'>
              <div class='col-lg-6'>
                <form method='post'>
                  <input type='number' name='logout' class='form-control' />
                  <div class='text-center mt-2'>
                    <button type='submit' name="logout_btn" class='btn btn-primary fw-bold btn-lg'>Send</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>