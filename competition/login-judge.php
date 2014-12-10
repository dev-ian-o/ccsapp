<?php include('common/header.php');?>
<?php include('../includes/classes/Judges.php');?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php require_once '../includes/Classes/Events.php';?>
<?php
  
  session_start();
  if(isset($_SESSION)) session_destroy();
  $rowCompetition = json_decode(Competition::fetch());
  $rowEvent = json_decode(Events::fetch());
?>
<?php error_reporting(0);?>
  <body>
  <div class="container">

    <h3>Login Judge</h3>
    <form method="post">

      <label for="event_id">Event's name:</label>
      <select id="event_id" class="form-control" name="event_id">

        <?php foreach ($rowEvent as $key => $value):?>
        <option><?= $value->event_name?></option>                 
        <?php endforeach;?>
      </select>

      <label for="competition_id">Competition's name:</label>
      <select id="competition_id" class="form-control" name="competition_id">

        <?php foreach ($rowCompetition as $key => $value):?>
        <option value="<?= $value->competition_id?>"><?= $value->competition_description?></option>                 
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
      $_SESSION['event_id'] = $judge[0]->event_id;
      // $_SESSION['competition_id'] = $_POST['competition_id'];
      $_SESSION['judge_name'] = $judge[0]->name;
      if($judge[0]->judges_id)
      {
        if($_POST['competition_id'] != 9)
          echo "<script>location.href = 'new.php?id=".$_POST['competition_id']."';</script>";
        else
          echo "<script>location.href = 'top-five.php?let-me-in=ianolinares&id=".$_POST['competition_id']."';</script>";

      }

        // echo "<script>location.href = 'new.php?id="+$_POST['competition_id']+"';</script>";
    }

  }
?>
