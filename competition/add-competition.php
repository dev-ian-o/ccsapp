<?php include('common/header.php');?>
<?php include('../includes/classes/Competition.php');?>

  <body>
  <div class="container">

    <h1>Add Competition</h1>
    <form method="post">
      <input type="hidden" name="image" value="">
      <label for="competition_name">Competition Name</label>
      <input id="competition_name" name="competition_name" type="text" class="form-control" required>

      <label for="competition_description">Competition Description</label>
      <input id="competition_description" name="competition_description" type="text" class="form-control" required> 
      <br>
      <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" style="position: absolute;left: 45%;">
    </form>
    </body>
  </div>
<?php include('common/footer.php');?>


<?php 
  if(isset($_POST['submit'])){
    // $arr = $_POST;
    
    // Competition::add($arr);
    // echo "<script> alert('Successfully added!');</script>";

  }
?>


