<?php

require_once "classes/Allowance.php";

//add process form is here
if (isset($_POST['btn_submit'])) {
  $allow_description = $_POST['form_desc'];
  $allow_id = $_POST['edit_allow'];
  

  if (empty($allow_description)) {
    echo "<script>alert('This field is required')</script>";
  } else {
    if (empty($allow_id)) {
      $dept = new Allowance();
      $dept->add_allowance($allow_description);

    } else {
      $allw = new Allowance();
      $allw->edit_allow($allow_description, $allow_id);
      echo "<script>alert('Done')</script>";
    }
  }
}

//delete process form is here
if (isset($_POST['btn_delete'])) {
  $allow_id = $_POST['form_delete'];
  // echo "am here";
  // exit();

  $dpt = new Allowance();
  $deleted = $dpt->delete_allow($allow_id);
  if ($deleted) {
    echo "<script>alert('Deleted successfully');
      window.location.href = 'index.php?allowances';      
      </script>";
  }
}

$dept = new Allowance();
$get_allow = $dept->get_all_allow();
// echo "<pre>";
// print_r($get_allow);
// exit();



?>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3>Allowance Form</h3>
      </div>
      <div class="card-body">
        <form method="post">
          <input type="text" name="form_desc" id="great_desc" class="form-control" placeholder="Type Here">
          <input type="hidden" id="great_id" name="edit_allow">
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
              <th class="text-center">Allowance</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1; ?>
            <?php foreach ($get_allow as $key) { ?>
              <tr>
                <td>
                  <?php echo $sn++; ?>
                </td>
                <td>
                  <?php echo $key['allow_description'];?>
                  <input type="hidden" class="hidden_id" value="<?php echo $key['allow_id']; ?>">
                  <input type="hidden" class="hidden_description" value="<?php echo $key['allow_description']; ?>">
                </td>
                <td class="text-center d-flex">
                  <button class="btn btn-primary mx-4" onclick="edit_me(this);">Edit</button>
                  <form method="post">
                    <input type="hidden" name="form_delete" value="<?php echo $key['allow_id']; ?>">
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