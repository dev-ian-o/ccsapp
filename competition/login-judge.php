<?php include('common/header.php');?>
<?php include('../includes/classes/Judges.php');?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php
  
  session_start();
  session_destroy();
  $rowCompetition = json_decode(Competition::fetch());
?>
<?php error_reporting(0);?>
  <body>
  <div class="container">

    <h3>Login Judge</h3>
    <form method="post">

      <label for="competition_id">Name:</label>
      <select id="competition_id" class="form-control" name="competition_id">

        <?php foreach ($rowCompetition as $key => $value):?>
        <option><?= $value->competition_description?></option>                 
        <?php endforeach;?>
      </select>
      <label for="name">Name:</label>
      <input id="name" name="name" type="text" class="form-control" required>  
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
      $_SESSION['competition_id'] = $judge[0]->competition_id;
      if($judge[0]->judges_id)
        echo "<script>location.href = 'new.php';</script>";
    }

  }
?>
