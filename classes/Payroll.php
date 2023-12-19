<?php
include "Db.php";

class Payroll extends Db
{
  public function create_payroll($emp_no, $payroll_amount)
  {
    $sql = "INSERT INTO payroll(emp_no, payroll_amount) VALUES(?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $emp_no, PDO::PARAM_STR);
    $stmt->bindParam(2, $payroll_amount, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Done')</script>";
  }
}


$pay = new Payroll();
//echo $pay->create_staff();
?>