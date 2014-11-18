<?php include('common/header.php');?>
<?php include('../includes/classes/Judges.php');?>
<?php error_reporting(0);?>
  <body>
  <div class="container">

    <h3>Login Judge</h3>
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
    $judge = json_decode(Judges::findByName($arr['name']));
  
    if(!$judge){echo "<script>alert('Invalid Judge!');</script>";}
    else{      
      session_destroy();
      session_start();
      $_SESSION['judges_id'] = $judge[0]->judges_id;
      echo "<script>location.href = 'index.php';</script>";
    }

  }
?>
