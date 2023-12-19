<?php
require_once "classes/Staff.php";
require_once "utilities/ExtractTime.php";

$time = new ExtractTime();


if(isset($_GET['details'])){
    $emp_no = $_GET['details'];
}
if(isset($_GET['start'])){
  $start = $_GET['start'];
}

if(isset($_GET['end'])){
  $end = $_GET['end'];
}
$staff = new Staff();
$empty_field = '-';
$total_overtime = 0;
$total_housing = 0;
$total_reimburse = 0;
$total_latecoming = 0;
$total_loan = 0;
$total_salary_advance = 0;
$get_staff = $staff->fetch_staff($emp_no, $start, $end);
$more_details = $staff->staff_details($emp_no);
// echo "<pre>";
// print_r($more_details);
// exit();
foreach($get_staff as $staff_details){
        if($staff_details['allow_id'] == 2 ){
          $total_overtime += $staff_details["allow_amount"];
        }
        if($staff_details['allow_id'] == 1 ){
          $total_housing += $staff_details["allow_amount"];
        }
        if($staff_details['allow_id'] == 4 ){
          $total_reimburse += $staff_details["allow_amount"];
        }
        if($staff_details['ded_id'] == 1 ){
          $total_latecoming += $staff_details["ded_amount"];
        }
        if($staff_details['ded_id'] == 2 ){
          $total_loan += $staff_details["ded_amount"];
        }
        if($staff_details['ded_id'] == 4 ){
          $total_salary_advance += $staff_details["ded_amount"];
        }
}
// echo $total_salary_advance;
// exit();
?>


<div class="row">
  <div class="col-md-6 m-auto">
    <div class="row">
      <div class="col d-flex align-items-center justify-content-around">
        <div><H5>CONFIDENTIAL</H5></div>
        <div class='bg-light'>
          <h5 class='text-center'>Pay Slip</h5>
          <hr>

          <p><?php echo  $time->convertToEnglishDate($start)  . " - " . $time->convertToEnglishDate($end); ?></p>
        </div>
        <div><h5>CONFIDENTIAL</h5></div>
      </div>
      <div class='d-flex justify-content-around'>
        <div>
          <h5><span class='fw-bolder'>Name :- </span><?php echo $more_details['staff_name'];?></h5>
          <h5><span class='fw-bolder'>Employee No :- </span><?php echo $more_details['emp_no'];?></h5>
        </div>
        <div>
          <h5><span class='fw-bolder'>Position :- </span><?php echo $more_details['level_name'];?></h5>
          <h5><span class='fw-bolder'>Department :- </span><?php echo $more_details['dept_name'];?></h5>
        </div>
      </div>
      <div class='d-flex justify-content-around mt-4'>
        <div>
          <h5 class='bg-info fw-bolder'>Description</h5>
          <div>
            <ul class='list-unstyled'>
              <li>Basic Salary</li>              
              <li>Overtime</li>
              <li>Housing Allowance</li>
              <li>Re-imbursement</li>
              <li>Late Coming</li>
              <li>Loan</li>
              <li>Salary Advance</li>
              <li class='fw-bolder'>Total</li>
              <li class='fw-bolder mt-4'>Net Pay</li>
            </ul>
          </div>        
        </div>
        <div>
          <h5 class='bg-info fw-bolder'>Earnings</h5>
        <div>
          <ul class='list-unstyled'>          
            <li><?php echo number_format($more_details['salary'], 2);?></li>                      
            <li><?php echo number_format($total_overtime, 2);?></li>
            <li><?php echo number_format($total_housing, 2);?></li>
            <li><?php echo number_format($total_reimburse, 2);?></li>
            <li><?php echo $empty_field;?></li>
            <li><?php echo $empty_field;?></li>
            <li><?php echo $empty_field;?></li>
            <li class='fw-bolder'><?php echo number_format($more_details['salary']+$total_overtime+$total_housing+$total_reimburse, 2);?></li>
            <li class='fw-bolder mt-4 ms-5'><?php echo number_format($more_details['salary']+$total_overtime+$total_housing+$total_reimburse-$total_latecoming-$total_loan-$total_salary_advance, 2);?></li>
          </ul>
        </div>        
        </div>        
        <div>
          <h5 class='bg-info fw-bolder'>Deductions</h5>
        <div>
          <ul class='list-unstyled'>
          <li><?php echo $empty_field;?></li>
          <li><?php echo $empty_field;?></li>
          <li><?php echo $empty_field;?></li>
          <li><?php echo $empty_field;?></li>
          <li><?php echo number_format($total_latecoming, 2);?></li>
          <li><?php echo number_format($total_loan, 2);?></li>
          <li><?php echo number_format($total_salary_advance, 2);?></li>
          <li class='fw-bolder'><?php echo number_format($total_latecoming+$total_loan+$total_salary_advance, 2);?></li>
          </ul>
        </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
