<?php
require_once "Db.php";

class Deduction extends Db
{
  public function add_deduction($ded_description)
  {
    $sql = "INSERT INTO deductions(ded_description) VALUES(?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $ded_description, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Done');
    window.location.href = 'index.php?deductions';
    </script>";
  }

  public function get_all_deduc()
  {
    $sql = "SELECT * FROM deductions";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $dept = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dept;
  }

  public function edit_deduc($ded_description, $ded_id)
  {
    $sql = "UPDATE deductions SET ded_description = ? WHERE ded_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $ded_description, PDO::PARAM_STR);
    $stmt->bindParam(2, $ded_id, PDO::PARAM_INT);
    $updated = $stmt->execute();
    return $updated;
  }

  public function delete_deduc($ded_id)
  {
    $sql = "DELETE FROM deductions WHERE ded_id  = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindparam(1, $ded_id, PDO::PARAM_INT);
    $deleted = $stmt->execute();
    return $deleted;
  }

}

$dept = new Deduction();
//echo $dept->add_deduction(4000, 'overtime');
//$dept->edit_dept('marketing', 5);
//$dept->delete_dept(6);
?>