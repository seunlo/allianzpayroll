<?php
require_once "classes/Staff.php";
require_once "classes/Department.php";
require_once "classes/Level.php";

$all = new Staff();
$get = $all->fetch_all_staff();
$all = new Department();
$get_dept = $all->get_all_dept();
$all = new Level();
$get_pos = $all->get_all_level();
// echo "<pre>";
// print_r($get);
// exit();

if(isset($_POST['btn_submit'])){
    $staff_name = $_POST['staffname'];
    $staff_email = $_POST['staffemail'];
    $staff_phone = $_POST['staffphone'];
    $staff_username = $_POST['staffusername'];
    $staff_password = $_POST['password'];
    $dept_id = $_POST['form_dept'];
    $level_id = $_POST['form_level'];
  
    $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);
  
    $staff = new Staff();
    $response = $staff->create_staff($staff_name, $staff_email, $staff_phone, $staff_username, $staff_password, $dept_id, $level_id);
    if ($response) {
      echo "<script>alert('Staff Registered successfully');
      window.location.href='index.php?employee';      
      </script>";      
    }
  }
?>

<div class="container">
	<div class="row mt-3">
		<div class="col-md-9 mb-4 m-auto">
			<div class="card mb-4">
				<div class="row">
					<div class="col">
						<h3 class="text-center mt-3">View Employee</h3>
                        <button type='button' class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#mywork2">+Add Employee</button>

                        <div class="modal fade" id="mywork2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h6 class="fw-bold" id="exampleModalLabel">Fill the form below to register a staff</h6>
                            </div>
                            <div class="modal-body">
                            <div class='container'>
                                <div class='row justify-content-center my-5'>
                                <div class='col-lg-6'>
                                <form method="post" >
                                        <input type="text" name="staffname" class="form-control" placeholder="FullName">
                                        <input type="email" name="staffemail" class="form-control" placeholder="EmailAddress">
                                        <input type="number" name="staffphone" class="form-control" placeholder="PhoneNumber">
                                        <input type="text" name="staffusername" class="form-control" placeholder="UserName">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        <select name="form_dept" class="form-select text-secondary mb-3">
                                        <option value="">Select Dept</option>
                                        <?php foreach ($get_dept as $value) { ?>
                                        <option value="<?php echo $value['dept_id']; ?>">
                                            <?php echo $value['dept_name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>          
                                        <select name="form_level" class="form-select text-secondary">
                                        <option value="">Select Position</option>
                                        <?php foreach ($get_pos as $blue) { ?>
                                        <option value="<?php echo $blue['level_id']; ?>">
                                            <?php echo $blue['level_name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
                                    <input type="submit" class="btn btn-primary w-100" value="Register" name="btn_submit">
                                </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>



						<table class='table table-bordered mt-3'>
							<thead class="bg-danger">
								<tr class='text-center'>
									<th>S/N</th>
									<th>Full Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Username</th>
									<th>Employe No</th>
								</tr>
							</thead>
							<tbody>
								<?php $sn = 1; ?>
                                <?php foreach ($get as $key) { ?>								
									<tr class='text-center'>
										<td scope="row">
											<?php echo $sn++; ?>
										</td>
										<td><?php echo $key['staff_name'];?></td>
										<td><?php echo $key['staff_email'];?></td>
										<td><?php echo $key['staff_phone'];?></td>
										<td><?php echo $key['staff_username'];?></td>
										<td><?php echo $key['emp_no'];?></td>
									</tr>
                                    <?php } ?>								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>