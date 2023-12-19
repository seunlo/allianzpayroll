<?php

require_once "classes/Level.php";
require_once "classes/Department.php";

$level = new Level();
$hi = new Department();
$get_dept = $hi->get_all_dept();
//$get_level = $level->get_all_level();
$dept_post = $hi->fetch_all_dept_position();
// echo "<pre>";
// print_r($dept_post);
// exit();

if (isset($_POST['btn_submit'])) {
  $dept_id = $_POST['select_dept'];
  $level_name = $_POST['dept_name'];
  $salary = $_POST['form_sal'];
  $level_id = $_POST['edit_id'];
//   echo " $dept_id  ....  dept_id,  $level_name .....  level_name,   $level_id .....  level_id";
//  exit();

  if (empty($dept_id) || empty($level_name)) {
    echo "<script>alert('All field is required')</script>";
  }else {
    if (empty($level_id)) {
      $dept = new Level();
      $dept->add_level($dept_id, $level_name);
    } else {
      $dept = new Level();
      $dept->edit_level($dept_id, $level_name, $salary, $level_id);
      echo "<script>alert('Done');
      window.location.href = 'index.php?position'; 
      </script>";
    }
  }  
}
?>
<!-------------- delete process ------------>
<?php
if (isset($_POST['level_delete'])) {
  $level_id = $_POST['level_id'];
  // echo 'hi';
  // die();

  $dpt = new Level();
  $deleted = $dpt->delete_level($level_id);
  if ($deleted) {
    echo "<script>alert('Deleted successfully');
      window.location.href = 'index.php?position';      
      </script>";
  }
}
?>
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3>Position Form</h3>
      </div>
      <div class="card-body">
        <form method="post">
          <select name="select_dept" id="great_amt" class="form-select">
            <option value="">Select Department</option>
            <?php foreach ($get_dept as $key) { ?>
              <option value="<?php echo $key['dept_id']; ?>">
                <?php echo $key['dept_name']; ?>
              </option>
            <?php } ?>
          </select>
          <input type="hidden" id="great_id" name="edit_id">
          <input type="text" name="dept_name" id="great_desc" class="form-control mt-3" placeholder='Type Position Name'>
          <input type="number" name="form_sal" id="great_sal" class="form-control mt-3" placeholder='Salary Amount'>
          <input type="submit" value="Submit" name="btn_submit" class="btn btn-primary mt-4">
          <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger mt-4">
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
      <table class="table display" id="transaction">
          <thead>
            <tr>
              <th class="text-center">S/N</th>
              <th class="text-center">Position</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1; ?>
            <?php foreach ($dept_post as $key) { ?>
              <tr>
                <td>
                  <?php echo $sn++; ?>
                </td>                
                <td>
                  <p><b>Dept:</b>
                    <?php echo $key['dept_name']; ?>
                  </p>
                  <p><b>Position:</b>
                    <?php echo $key['level_name']; ?>
                  </p>
                  <p><b>Salary:</b>
                    <?php echo $key['salary']; ?>
                  </p>

                  <input type="hidden" class="hidden_id" value="<?php echo $key['dept_id']; ?>">
                  <input type="hidden" class="hidden_amount" value="<?php echo $key['level_id']; ?>">
                  <input type="hidden" class="hidden_description" value="<?php echo $key['level_name']; ?>">
                  <input type="hidden" class="hidden_salary" value="<?php echo $key['salary']; ?>">
                </td>
                <td class="text-center d-flex">
                  <button type = "button" class="btn btn-primary mx-4" name="" onclick="edit_position(this);">
                    Edit
                  </button>
                  <form method="post">
                    <input type="hidden" name="level_id" value="<?php echo $key['level_id']; ?>">
                    <button type="submit" class="btn btn-danger" name="level_delete">delete</button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
      </div>
    </div>
  </div>
</div>