<?php
require_once "Db.php";

class Department extends Db
{
  public function create_department($dept_name)
  {
    $sql = "INSERT INTO department(dept_name) VALUES(?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $dept_name, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Done')</script>";
  }

  public function edit_dept($dept_name, $dept_id)
  {
    $sql = "UPDATE department SET dept_name = ? WHERE dept_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $dept_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $dept_id, PDO::PARAM_INT);
    $updated = $stmt->execute();
    return $updated;
  }

  public function delete_dept($dept_id)
  {
    $sql = "DELETE FROM department WHERE dept_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindparam(1, $dept_id, PDO::PARAM_INT);
    $deleted = $stmt->execute();
    return $deleted;
  }

  public function get_all_dept()
  {
    $sql = "SELECT * FROM department";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $dept = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dept;
  }

  public function fetch_all_dept_position()
  {
    $sql = "SELECT level.level_name, department.dept_name, level.level_id, department.dept_id, level.salary
    FROM level
    JOIN department ON department.dept_id = level.dept_id;";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $customers;
  }
}

$dept = new Department();
//echo $dept->create_department('IT Department');
//$dept->edit_dept('marketing', 5);
//$dept->delete_dept(6);
?>