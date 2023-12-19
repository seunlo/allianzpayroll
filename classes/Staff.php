<?php
include "Db.php";
include_once "RandomNumber.php";

class Staff extends Db
{
  public function create_staff($staff_name, $staff_email, $staff_phone, $staff_username, $staff_password, $dept_id, $level_id)
  {
    $sql = "SELECT * FROM staff WHERE staff_username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $staff_username, PDO::PARAM_STR);
    $stmt->execute();
    $rowCount = $stmt->rowCount();
    if ($rowCount > 0) {
      echo "<script>alert('Username is already registered')</script>";
    } else {
      $number = new RandomNumber();
      $emp_no = $number->generateNumber(6);
      $sql = "INSERT INTO staff(staff_name, staff_email, staff_phone, staff_username, staff_password, emp_no, dept_id, level_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $staff_name, PDO::PARAM_STR);
      $stmt->bindParam(2, $staff_email, PDO::PARAM_STR);
      $stmt->bindParam(3, $staff_phone, PDO::PARAM_STR);
      $stmt->bindParam(4, $staff_username, PDO::PARAM_STR);
      $stmt->bindParam(5, $staff_password, PDO::PARAM_STR);
      $stmt->bindParam(6, $emp_no, PDO::PARAM_STR);
      $stmt->bindParam(7, $dept_id, PDO::PARAM_INT);
      $stmt->bindParam(8, $level_id, PDO::PARAM_INT);
      $stmt->execute();
      echo "<script>alert('Staff Registered Successfully')</script>";
    }
  }
  public function staff_login($staff_username, $staff_password)
  {

    $sql = "SELECT * FROM staff WHERE staff_username = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $staff_username, PDO::PARAM_STR);
    $stmt->execute();

    $get_user = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($get_user);
    // exit();    

    $password_matches = password_verify($staff_password, $get_user['staff_password']);

    //if it matches::set session
 
    if ($password_matches) {
     
      $_SESSION["staff_id"] = $get_user["staff_id"];

      $action = "Logged in";
      $audit_date = Date('Y-m-d');

      $sql = "SELECT emp_no FROM audit_log WHERE emp_no = ? and audit_date = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $get_user['emp_no'], PDO::PARAM_STR);
      $stmt->bindParam(2, $audit_date, PDO::PARAM_STR);
      $stmt->execute();
      $staff_count = $stmt->rowCount();
      if ($staff_count > 0) {
        return "you already logged in";
        exit();
      }
 

      $sql = "INSERT INTO audit_log(emp_no, action, audit_date) VALUES (?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $get_user['emp_no'], PDO::PARAM_INT);
      $stmt->bindParam(2, $action, PDO::PARAM_STR);
      $stmt->bindParam(3, $audit_date, PDO::PARAM_STR);
      $stmt->execute();      

      echo '<script> window.location.href = "./index.php?home" </script>';
      exit();
    }
    //return error message
    return "Either Username or Password is incorrect";
  }

  public function fetch_staff($emp_no, $start, $end)
  {
    $sql = "SELECT tracker.ded_id, tracker.ded_amount, tracker.allow_id, tracker.allow_amount, tracker.date, deductions.ded_description, allowance.allow_description
    FROM tracker
    LEFT JOIN deductions ON deductions.ded_id = tracker.ded_id
    LEFT JOIN allowance ON allowance.allow_id = tracker.allow_id
    WHERE tracker.emp_no = ? AND tracker.date BETWEEN ? AND ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $emp_no, PDO::PARAM_STR);
    $stmt->bindParam(2, $start, PDO::PARAM_STR);
    $stmt->bindParam(3, $end, PDO::PARAM_STR);
    $stmt->execute();
    $customer = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
    return $customer;
  }

  public function staff_details($emp_no){
    $sql = "SELECT staff.staff_name, staff.emp_no, department.dept_name, level.level_name, level.salary
    FROM staff
    JOIN department ON department.dept_id = staff.dept_id
    JOIN level ON level.level_id = staff.level_id
    WHERE staff.emp_no = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $emp_no, PDO::PARAM_STR);
    $stmt->execute();
    $staff_details = $stmt->fetch(PDO::FETCH_ASSOC);
    return $staff_details;
  }


  public function staff_logout($emp_no)
  {

    if (empty($emp_no)) {
      echo "hello";
    }
    session_start();
    session_destroy();
    $logged_out_action = "Logged out";
    $logged_out_date = Date('Y-m-d h:i:s');
    $audit_date = Date('Y-m-d');

    $sql = "SELECT emp_no FROM audit_log WHERE emp_no = ? and audit_date = ?  logged_out_action = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $get_user['emp_no'], PDO::PARAM_STR);
    $stmt->bindParam(2, $audit_date, PDO::PARAM_STR);
    $stmt->bindParam(3, $logged_out_action, PDO::PARAM_STR);
    $stmt->execute();

    $staff_count = $stmt->rowCount();
    if ($staff_count > 0) {
      return "youn have  already logged out";
      exit();
    }


    $sql = "update audit_log set logged_out_date = ?, logged_out_action = ? where audit_date = ? and emp_no = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $logged_out_date, PDO::PARAM_STR);
    $stmt->bindParam(2, $logged_out_action, PDO::PARAM_STR);
    $stmt->bindParam(3, $audit_date, PDO::PARAM_STR);
    $stmt->bindParam(4, $emp_no, PDO::PARAM_STR);
    $stmt->execute();

    header('location:./login.php');
  }
  public function fetch_all_staff()
  {
    $sql = "SELECT * FROM staff";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $staff;
  }

}

$staff = new Staff();
//echo $staff->create_staff('seun jacobs', 'seunlo@gmail.com', '08028348422', 'seunlo', 'plot');
//echo $staff->staff_login('seunlo', 'plot');
//$all_customer = $customer->fetch_customer(1);
// echo "<pre>";
// print_r($all_customer);


// SELECT
// tracker.emp_no,
// tracker.date,
// tracker.ded_id,
// tracker.ded_amount,
// deductions.ded_description,
// tracker.allow_id,
// tracker.allow_amount,
// allowance.allow_description,
// staff.staff_name,
// level.level_name,
// level.salary,
// department.dept_name
// FROM
// tracker
// LEFT JOIN deductions ON deductions.ded_id = tracker.ded_id
// LEFT JOIN allowance ON allowance.allow_id = tracker.allow_id
// LEFT JOIN staff ON staff.emp_no = tracker.emp_no
// LEFT JOIN level ON level.level_id = staff.level_id
// LEFT JOIN department ON department.dept_id = staff.dept_id
// WHERE
// tracker.emp_no = 904776;

?>