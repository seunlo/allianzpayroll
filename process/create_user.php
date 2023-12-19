<?php
require_once "../classes/Customer.php";

if (isset($_POST["reg_btn"])) {
  $cust_full_name = $_POST["fullname"];
  $cust_phone_no = $_POST["phone"];
  $cust_password = $_POST["password"];
  $acct_type_id = $_POST["account_type"];
  $hacked_password = password_hash($cust_password, PASSWORD_DEFAULT);

  $customer = new Customer();
  $customer->create_customer($cust_full_name, $cust_phone_no, $hacked_password, $acct_type_id);
}
?>