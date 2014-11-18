<?php include('common/header.php');?>
<?php include('../includes/classes/Judges.php');?>
  <body>
  <div class="container">

    <h1>Registration Form</h1>
    <h3>Add Judges</h3>
    <form method="post">
      <label for="firstname">Name:</label>
      <input id="firstname" name="name" type="text" class="form-control">  
      <input id="firstname" name="competition_id" type="hidden" value="1" class="form-control">
      
      <br>
      <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" style="position: absolute;left: 45%;">

    </form>
    </body>
  </div>
<?php include('common/footer.php');?>

<?php 
  if(isset($_POST['submit'])){
    $arr = $_POST;
    Judges::add($arr);
    echo "<script> alert('Successfully added!');</script>";

  }
?>
