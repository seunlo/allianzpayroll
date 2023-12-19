<?php
require_once "classes/Audit.php";
require_once "utilities/ExtractTime.php";
?>

<div class="container">
	<div class="row mt-3">
		<div class="col-md-9 mb-4 m-auto">
			<div class="card mb-4">
				<div class="row">
					<div class="col">
						<h3 class="text-center mt-3">View Attendance</h3>
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
						<table class='table table-bordered mt-3'>
							<thead class="bg-danger">
								<tr class='text-center'>
									<th>S/N</th>
									<th>Full Name</th>
									<th>Employee No</th>
									<th>Time In</th>
									<th>Time Out</th>
									<th>Date</th>
								</tr>
							</thead>
							<?php 
								if(isset($_POST['date_submit'])){
									$start = $_POST['form_start'];
									$end = $_POST['form_end'];

									$audit = new Audit();
									$timeextractor = new ExtractTime();
									$get_login = $audit->fetch_all_login_trail($start, $end);
									// echo "<pre>";
									// print_r($get_login);
									// exit();
							?>
							<tbody>
								<?php $sn = 1; ?>
								<?php foreach ($get_login as $key) { ?>
									<tr class='text-center'>
										<td><?php echo $sn++; ?></td>
										<td><?php echo $key['staff_name']; ?></td>
										<td><?php echo $key['emp_no']; ?></td>
										<td><?php echo $timeextractor->timeExtractor($key['action_date']); ?></td>
										<td>
											<?php											
											 if(!empty($key['logged_out_date'])){
												echo $timeextractor->timeExtractor($key['logged_out_date']);
											 }else{
												echo $key['logged_out_date'];
											 }
											 ?>
										</td>
										<td><?php echo $key['audit_date'];?></td>
									</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>