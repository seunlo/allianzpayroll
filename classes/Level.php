<?php
require_once "Db.php";

class Level extends Db
{
  public function add_level($dept_id, $level_name)
  {
    $sql = "INSERT INTO level(dept_id, level_name) VALUES(?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $dept_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $level_name, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Done');
    window.location.href = 'index.php?position';
    </script>";
  }
  public function get_all_level()
  {
    $sql = "SELECT * FROM level";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $dept = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dept;
  }

  public function get_level_by_id($level_id)
  {
    $sql = "select level.dept_id, level.level_name
    FROM level WHERE level.dept_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $dept = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dept;
  }

  public function delete_level($level_id)
  {
    $sql = "DELETE FROM level WHERE level_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindparam(1, $level_id, PDO::PARAM_INT);
    $deleted = $stmt->execute();
    return $deleted;
  }

  public function edit_level($dept_id, $level_name, $salary, $level_id)
  {
    $sql = "UPDATE level SET dept_id = ?, level_name = ?, salary = ? WHERE level_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $dept_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $level_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $salary, PDO::PARAM_STR);
    $stmt->bindParam(4, $level_id, PDO::PARAM_INT);
    $updated = $stmt->execute();
    return $updated;
  }

}

$dept = new Level();
//echo $dept->add_level(1, 'manager');
//$dept->edit_level(1, 'clerk', 2);
//$dept->delete_dept(6);
?>