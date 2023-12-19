<?php
require_once "Db.php";

class Audit extends Db
{

  public function fetch_all_login_trail($start, $end)
  {
    $date = Date('Y-m-d');
    $action = 'Logged in';
    $sql = "SELECT audit_log.action_date, audit_log.action, audit_log.logged_out_date, audit_log.logged_out_action, audit_log.audit_date, staff.staff_name, staff.emp_no
    FROM audit_log 
    JOIN staff ON staff.emp_no = audit_log.emp_no
    WHERE audit_log.audit_date BETWEEN ? AND ?";
     $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $start, PDO::PARAM_STR);
    $stmt->bindParam(2, $end, PDO::PARAM_STR);
    $stmt->execute();
    $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($staff);
    // exit();
    return $staff;
  }

  public function trail_monthly()
  {
 
    $sql = "SELECT  staff.emp_no,
     department.dept_name, level.salary, 
    audit_log.action_date, audit_log.logged_out_date FROM `staff` 
   JOIN department ON staff.dept_id = department.dept_id 
   JOIN level ON staff.level_id = level.level_id
   JOIN audit_log on staff.emp_no = audit_log.emp_no";
     $stmt = $this->connect()->prepare($sql);
     $stmt->bindParam(1, $start, PDO::PARAM_STR);
     $stmt->bindParam(2, $end, PDO::PARAM_STR);
    $stmt->execute();
    $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($staff);
    // exit();
    return $staff;
  }


  // public function payroll_logic(){

  //   $sql = "SELECT staff.staff_name, staff.staff_email, staff.staff_username, staff.emp_no,
  //    staff.staff_phone, department.dept_name, level.level_name, level.salary, level.level_id, audi
  //    department.dept_id FROM `staff` 
  //   JOIN department ON staff.dept_id = department.dept_id 
  //   JOIN level ON staff.level_id = level.level_id";
  //   $stmt = $this->connect()->prepare($sql);
  //   $stmt->execute();
  //   $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //   return $staff;

  //   $start_time = '8:00';
  //   $close_time = '17:00';
  //   $time_sheet = $this->fetch_all_login_trail();

  //   $lateness = 0;
  //   foreach($time_sheet as $key){
  //       if($key['start_date'] > $start_time){
  //         $lateness++;
  //       }
  //   }
  //  $total_lateness =  $lateness * 2300;
  // }
}

?>