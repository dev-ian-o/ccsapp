<?php include('common/header.php');?>
<?php include('../includes/classes/ScreeningRegistration.php');?>

  <body>
  <div class="container">

    <h1>Registration Form</h1>
    <h3>Mr. and Mrs. CSS Screening</h3>
    <form method="post">
      <input type="hidden" name="competition_id" value="1">
      <input type="hidden" name="image" value="">
      <label for="student_no">Student Number</label>
      <input id="student_no" name="student_no" type="text" class="form-control" required>  

      <label for="firstname">First Name:</label>
      <input id="firstname" name="firstname" type="text" class="form-control" required>  

      <label for="lastname">Last Name:</label>
      <input id="lastname" name="lastname" type="text" class="form-control" required>  

      <label for="gender">Gender</label>
      <select id="gender" name="gender" type="text" class="form-control">  
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>

      <label for="year">Year</label>
      <select id="year" name="year" type="text" class="form-control">  
        <option value="1">1st Year</option>
        <option value="2">2nd Year</option>
        <option value="3">3rd Year</option>
        <option value="4">4th Year</option>
      </select>

      <label for="section">Section</label>
      <select id="section" name="section" type="text" class="form-control">  
        <option value="AITSM">AITSM</option>
        <option value="BITSM">BITSM</option>
        <option value="CITSM">CITSM</option>
        <option value="ACNA">ACNA</option>
        <option value="BCNA">BCNA</option>
        <option value="CCNA">CCNA</option>
        <option value="ACSAD">ACSAD</option>
        <option value="BCSAD">BCSAD</option>
        <option value="CCSAD">CCSAD</option>
      </select>


      <label for="course">Course</label>
      <select id="course" name="course" type="text" class="form-control">  
        <option value="BSITSM">BS ITSM</option>
        <option value="BSCSAD">BS CSAD</option>
        <option value="BSCNA">BS CNA</option>
      </select>
      <br>
      <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" style="position: absolute;left: 45%;">
    </form>
    </body>
  </div>
<?php include('common/footer.php');?>


<?php 
  if(isset($_POST['submit'])){
    $arr = $_POST;
    $var = ScreeningRegistration::countByGender($arr);
    $arr['contestant_no'] = $var[0]["number"]+1;
    

    ScreeningRegistration::add($arr);
    echo "<script> alert('Successfully added!');</script>";

  }
?>


