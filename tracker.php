<?php
require_once "classes/Tracker.php";
require_once "classes/Allowance.php";
require_once "classes/Deduction.php";

$allow = new Allowance();
$get_allow = $allow->get_all_allow();

$ded = new Deduction();
$get_ded = $ded->get_all_deduc();
// echo "<pre>";
// print_r($get);
// exit();

if(isset($_POST['btn_submit'])){
    $emp_no = $_POST['form_emp_no'];
    $ded_id = $_POST['form_ded_id'];
    $allow_id = $_POST['form_allow_id'];
    $ded_amount = $_POST['form_ded_amount'];
    $allow_amount = $_POST['form_allow_amount'];
    $date = $_POST['form_date'];

    $track = new Tracker();
    $create = $track->create_track($emp_no, $ded_id, $allow_id, $ded_amount, $allow_amount, $date);
    if ($create) {
      echo "<script>alert('Done');
        window.location.href = 'index.php?tracker';      
        </script>";
    }
}
?>

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h3>Tracker Form</h3>
      </div>
      <div class="card-body">
        <form method="post">
          <input type="number" name="form_emp_no" class="form-control mb-3" placeholder='Employee No'>
          <select name="form_ded_id" class="form-select text-secondary mb-3">
            <option value="">Select deduction here</option>
            <?php foreach ($get_ded as $key) { ?>
              <option value="<?php echo $key['ded_id']; ?>">
                <?php echo $key['ded_description']; ?>
              </option>
            <?php } ?>
          </select>
          <input type="number" class="form-control mb-3" placeholder="amount" name="form_ded_amount">          
          <select name="form_allow_id" class="form-select text-secondary">
            <option value="">Select allowance here</option>
            <?php foreach ($get_allow as $key) { ?>
              <option value="<?php echo $key['allow_id']; ?>">
                <?php echo $key['allow_description']; ?>
              </option>
            <?php } ?>
          </select>
          <input type="number" class="form-control mt-3" placeholder="amount" name="form_allow_amount">          
          <input type="date" class="form-control mt-3" name="form_date" required>          
          <input type="submit" value="Submit" name="btn_submit" class="btn btn-primary mt-4">
          <input type="submit" value="Cancel" name="btn_cancel" class="btn btn-danger mt-4">
        </form>
      </div>
    </div>
  </div>


  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h2 class="text-center">Employee Tracker Information</h2>
        <form method="post">
					<div class="d-flex mt-5 justify-content-center align-items-center">
            <div>
              <label for="" class="ms-4">Start Date</label>
              <input type="date" name="form_start" class="form-control w-100 mb-3">
            </div>
            <div class='ms-4'>							
              <label for="" class="ms-4">End Date</label>
              <input type="date" name="form_end" class="form-control w-100 mb-3">
            </div>
            <div class='ms-4'>
              <input type="submit" class="btn btn-primary w-100" name="date_submit">	
            </div>								
					</div>													
				</form>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">S/N</th>
              <th class="text-center">Employee No</th>
              <th class="text-center">Deduction</th>
              <th class="text-center">Allowance</th>
              <th class="text-center">Date</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <?php 
								if(isset($_POST['date_submit'])){
									$start = $_POST['form_start'];
									$end = $_POST['form_end'];

									$all = new Tracker();
                  $get = $all->get_all_track($start, $end);
									// echo "<pre>";
									// print_r($get);
									// exit();
							?>
          <tbody>
            <?php $sn = 1; ?>
            <?php foreach ($get as $key) { ?>
              <tr>
                <td>
                  <?php echo $sn++; ?>
                </td>
                <td><?php echo $key['emp_no']; ?></td>
                <td><?php echo $key['ded_amount']; ?></td>
                <td><?php echo $key['allow_amount']; ?></td>
                <td><?php echo $key['date']; ?></td>
                <td class="text-center d-flex">
                  <button class="btn btn-primary mx-4" name="" onclick="edit_me(this);">Edit</button>
                  <form method="post">
                    <button type="submit" class="btn btn-danger" name="btn_delete">delete</button>
                  </form>
                </td>
              </tr>
            <?php } 
            }?>
          </tbody>
      </div>
    </div>
  </div>
</div>