<?php
require_once "classes/Tracker.php";
?>

<div class="container">
	<div class="row mt-3">
		<div class="col-md-9 mb-4 m-auto">
			<div class="card mb-4">
				<div class="row">
					<div class="col">
						<h3 class="text-center mt-3">View Payroll</h3>
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
									<th>Employe No</th>
									<th>Dept</th>
									<th>Expected Salary</th>
									<th>Deductions</th>
									<th>Allowances</th>
									<th>Actual Salary</th>
									<th>View Details</th>
								</tr>
							</thead>
							<?php 
							if(isset($_POST['date_submit'])){
								$start = $_POST['form_start'];
								$end = $_POST['form_end'];

								$all = new Tracker();
								$get = $all->fetch_allded($start, $end);
								// echo "<pre>";
								// print_r($get);
								// exit();
							?>
							<tbody>
								<?php $sn = 1; ?>
								<?php foreach ($get as $value){?>
								
									<tr class='text-center'>
										<td scope="row">
											<?php echo $sn++; ?>
										</td>
										<td><?php echo $value['emp_no'];?></td>
										<td><?php echo $value['dept_name'];?></td>
										<td><?php echo number_format($value['salary'], 2);?></td>
										<td><?php echo number_format($value['total_deductions'], 2);?></td>
										<td><?php echo number_format($value['total_allowance'], 2);?></td>
										<td><?php 
													$actual_salary = ($value['salary']  + $value['total_allowance']) - $value['total_deductions']; 
													echo number_format($actual_salary, 2);
										?></td>
										<td><a href="index.php?details=<?php echo $value['emp_no'];?>&start=<?php echo 	$start; ?>&end=<?php echo $end; ?>">click here for details</a></td>
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