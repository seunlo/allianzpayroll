<?php
session_start();
require_once "../classes/Customer.php";

if (isset($_POST['userLogin'])) {
  $cust_phone_no = $_POST["cust_number"];
  $cust_password = $_POST["cust_password"];

  $customer = new Customer();
  $log_customer = $customer->customer_login($cust_phone_no, $cust_password);
  if ($log_customer) {
    $_SESSION['error'] = "<script>alert('Either Phone No or Password is incorrect')</script>";
    header("location:../login.php");
    exit();
  }
}
?>