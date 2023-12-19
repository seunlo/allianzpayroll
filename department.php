<?php

require_once "classes/Department.php";

if (isset($_POST['btn_submit'])) {
  $dept_name = $_POST['dept_name'];
  $dept_id = $_POST['dept_id'];


  if (empty($dept_name)) {
    echo "<script>alert('This field is required')</script>";
  } else {
    if (empty($dept_id)) {
      $dept = new Department();
      $dept->create_department($dept_name);
    } else {
      $dept = new Department();
      $dept->edit_dept($dept_name, $dept_id);
    }

  }
}


$hi = new Department();
$get_dept = $hi->get_all_dept();
// echo "<pre>";
// print_r($get_dept);
?>

<?php
if (isset($_POST['btn_delete'])) {
  $dept_id = $_POST['dept_id'];
  // echo 'hi';
  // die();

  $dpt = new Department();
  $deleted = $dpt->delete_dept($dept_id);
  if ($deleted) {
    echo "<script>alert('Deleted successfully');
      window.location.href = 'index.php?department';      
      </script>";
  }
}
?>



<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3>Department Form</h3>
      </div>
      <div class="card-body">
        <form method="post">
          <label for="dept_name">Name</label>
          <input type="hidden" name="dept_id" id="great_id" />
          <textarea name="dept_name" id="great_desc" cols="7" rows="2" class="form-control"></textarea>
          <input type="submit" value="Submit" name="btn_submit" class="btn btn-primary mt-4">
          <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger mt-4">
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">S/N</th>
              <th class="text-center">Department</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1; ?>
            <?php foreach ($get_dept as $key) { ?>
              <tr>
                <td>
                  <?php echo $sn++; ?>
                </td>
                <td>
                  <?php echo $key['dept_name']; ?>
                  <input type="hidden" class="hidden_id" value="<?php echo $key['dept_id']; ?>">
                  <input type="hidden" class="hidden_description" value="<?php echo $key['dept_name']; ?>">
                </td>
                <td class="text-center d-flex">
                  <button class="btn btn-primary mx-4" name="" onclick="edit_me(this)">
                    Edit
                  </button>
                  <form method="post">
                    <input type="hidden" name="dept_id" value="<?php echo $key['dept_id']; ?>">
                    <button type="submit" class="btn btn-danger" name="btn_delete">delete</button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
      </div>
    </div>
  </div>
</div>