<?php

require_once "classes/Deduction.php";

if (isset($_POST['btn_submit'])) {
  $ded_description = $_POST['form_desc'];
  $ded_id = $_POST['goat_id'];

  if (empty($ded_description)) {
    echo "<script>alert('This field is required')</script>";
  }else {
    if (empty($ded_id)) {
      $dept = new Deduction();
      $dept->add_deduction($ded_description);

    } else {
      $dept = new Deduction();
      $dept->edit_deduc($ded_description, $ded_id);
      echo "<script>alert('Done')</script>";
    }
  } 

}

//delete process form is here
if (isset($_POST['btn_delete'])) {
  $ded_id = $_POST['form_delete'];
  // echo "am here";
  // exit();

  $dpt = new Deduction();
  $deleted = $dpt->delete_deduc($ded_id);
  if ($deleted) {
    echo "<script>alert('Deleted successfully');
      window.location.href = 'index.php?deductions';      
      </script>";
  }
}

$dept = new Deduction();
$get_ded = $dept->get_all_deduc();
// echo "<pre>";
// print_r($get_ded);
// exit();
?>
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3>Deductions Form</h3>
      </div>
      <div class="card-body">
        <form method="post">
          <input type="text" name="form_desc" id="great_desc" class="form-control" placeholder="Type Here">
          <input type="hidden" id="great_id" name="goat_id">
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
              <th class="text-center">Deduction</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1; ?>
            <?php foreach ($get_ded as $key) { ?>
              <tr>
                <td>
                  <?php echo $sn++; ?>
                </td>
                <td>
                  <?php echo $key['ded_description'];?>
                  <input type="hidden" class="hidden_id" value="<?php echo $key['ded_id']; ?>">
                  <input type="hidden" class="hidden_description" value="<?php echo $key['ded_description']; ?>">
                </td>
                <td class="text-center d-flex">
                  <button class="btn btn-primary mx-4" name="" onclick="edit_me(this);">Edit</button>
                  <form method="post">
                    <input type="hidden" name="form_delete" value="<?php echo $key['ded_id']; ?>">
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