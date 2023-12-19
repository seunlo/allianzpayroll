<?php
require_once "Db.php";

class Tracker extends Db
{
  public function create_track($emp_no, $ded_id, $allow_id, $ded_amount, $allow_amount, $date)
  {
    $sql = "INSERT INTO tracker(emp_no, ded_id, allow_id, ded_amount, allow_amount, date) VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $emp_no, PDO::PARAM_STR);
    $stmt->bindParam(2, $ded_id, PDO::PARAM_INT);
    $stmt->bindParam(3, $allow_id, PDO::PARAM_INT);
    $stmt->bindParam(4, $ded_amount, PDO::PARAM_STR);
    $stmt->bindParam(5, $allow_amount, PDO::PARAM_STR);
    $stmt->bindParam(6, $date, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Done')</script>";
  }

  public function fetch_allded($start, $end)
{
  
   $sql = "SELECT
                emp_info.emp_no,
                emp_info.dept_name,
                emp_info.salary,
                emp_info.late_count,
                emp_info.early_leave_count,
                tracker_summary.total_allowance,
                tracker_summary.total_deductions
            FROM (
                SELECT
                    staff.emp_no,
                    department.dept_name,
                    level.salary,
                    SUM(CASE WHEN TIME(audit_log.action_date) > '08:00:00' THEN 1 ELSE 0 END) AS late_count,
                    SUM(CASE WHEN TIME(audit_log.logged_out_date) < '17:00:00' THEN 1 ELSE 0 END) AS early_leave_count
                FROM
                    staff
                JOIN department ON staff.dept_id = department.dept_id
                JOIN level ON staff.level_id = level.level_id
                JOIN audit_log ON staff.emp_no = audit_log.emp_no
                WHERE  audit_log.audit_date BETWEEN ? AND ?
                GROUP BY
                    staff.emp_no, department.dept_name, level.salary
            ) AS emp_info
            LEFT JOIN (
                SELECT
                    tracker.emp_no,
                    SUM(tracker.allow_amount) AS total_allowance,
                    SUM(tracker.ded_amount) AS total_deductions
                FROM
                    tracker
                LEFT JOIN allowance ON allowance.allow_id = tracker.allow_id
                LEFT JOIN deductions ON deductions.ded_id = tracker.ded_id
                WHERE tracker.date BETWEEN ? AND ?
                GROUP BY
                    tracker.emp_no
            ) AS tracker_summary ON emp_info.emp_no = tracker_summary.emp_no";

    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $start, PDO::PARAM_STR);
    $stmt->bindParam(2, $end, PDO::PARAM_STR);
    $stmt->bindParam(3, $start, PDO::PARAM_STR);
    $stmt->bindParam(4, $end, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


  public function get_all_track($start, $end)
  {
    $sql = "SELECT * FROM tracker
    WHERE tracker.date BETWEEN ? AND ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $start, PDO::PARAM_STR);
    $stmt->bindParam(2, $end, PDO::PARAM_STR);
    $stmt->execute();
    $dept = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dept;
  }

}

$track = new Tracker();
//echo $track->create_track('036079', 2, 2, 3400);
//echo $track->action(904776);
?>