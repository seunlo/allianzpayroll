<div class="container-fluid footer">
  <div class="row bg-primary">
    <div class="col-md">
      <p class="text-center text-light fw-bolder py-2">
        Copyright &copy;
        <?php echo date("Y"); ?> All rights reversed!
      </p>

    </div>
  </div>
</div>
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/jquery.dataTables.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

  function edit_me(button) {
    //alert('hello');
    //get hidden value from DOM
    var row = button.closest('tr');
    var hiddenId = row.querySelector('.hidden_id').value;
    var hiddenDesc = row.querySelector('.hidden_description').value;
    //alert(hiddenDesc);   

    // Alert the dynamic dataet
    let editId = document.getElementById('great_id');
    editId.value = hiddenId;

    let editDesc = document.getElementById('great_desc');
    editDesc.value = hiddenDesc;

    //alert(allowId);
  }



  function edit_position(button) {
    //alert('hello');
    //get hidden value from DOM
    var row = button.closest('tr');
    var hiddenId = row.querySelector('.hidden_id').value;
    var hiddenAmt = row.querySelector('.hidden_amount').value;
    var hiddenDesc = row.querySelector('.hidden_description').value;
    var hiddenSal = row.querySelector('.hidden_salary').value;
    //alert(hiddenDesc);   

    // Alert the dynamic dataet
    let editId = document.getElementById('great_id');
    editId.value = hiddenAmt;


    //Department Id
    let editAmt = document.getElementById('great_amt');
    editAmt.value = hiddenId;

    // Description
    let editDesc = document.getElementById('great_desc');
    editDesc.value = hiddenDesc;

    // Salary
    let editSal = document.getElementById('great_sal');
    editSal.value = hiddenSal;

    //alert(allowId);
  }
</script>
<script>
  new DataTable('#transaction');
</script>
</body>

</html>