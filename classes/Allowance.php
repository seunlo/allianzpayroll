<?php
require_once "Db.php";

class Allowance extends Db
{
  public function add_allowance($allow_description)
  {
    $sql = "INSERT INTO allowance(allow_description) VALUES(?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $allow_description, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Done');
    window.location.href = 'index.php?allowances';
    </script>";
  }

  public function get_all_allow()
  {
    $sql = "SELECT * FROM allowance";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();
    $dept = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dept;
  }

  public function edit_allow($allow_description, $allow_id)
  {
    $sql = "UPDATE allowance SET allow_description = ? WHERE allow_id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $allow_description, PDO::PARAM_STR);
    $stmt->bindParam(2, $allow_id, PDO::PARAM_INT);
    $updated = $stmt->execute();
    return $updated;
  }

  public function delete_allow($allow_id)
  {
    $sql = "DELETE FROM allowance WHERE allow_id  = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindparam(1, $allow_id, PDO::PARAM_INT);
    $deleted = $stmt->execute();
    return $deleted;
  }

}

$dept = new Allowance();
//echo $dept->add_allowance(4000, 'overtime');
//$dept->edit_dept('marketing', 5);
//$dept->delete_dept(6);
?>