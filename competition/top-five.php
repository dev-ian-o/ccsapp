<link href="../lib/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
<?php  session_start();?>
<?php if(isset($_GET['let-me-in'])):?>
<?php if($_GET['let-me-in'] === "ianolinares"):?>

<?php if(!isset($_SESSION['competition_id']))echo "<script>alert('Login first');location.href='login-judge.php';</script>"; ?>
<?php if(!isset($_SESSION['event_id']))echo "<script>alert('Login first');location.href='login-judge.php';</script>"; ?>
<?php if(!isset($_SESSION['judges_id']))echo "<script>location.href='login-judge.php';</script>"; ?>
<?php include('common/header.php');?>
<?php include('../includes/classes/Criteria.php');?>
<?php include('../includes/classes/ScreeningRegistration.php');?>
<?php include('../includes/classes/Judges.php');?>
<?php include('../includes/classes/Scores.php');?>
<?php include('../includes/classes/competition.php');?>

<?php $contestantsMale = json_decode(ScreeningRegistration::findByEventIdWithGender($_SESSION['event_id'],"male"));?>
<?php $contestantsFemale = json_decode(ScreeningRegistration::findByEventIdWithGender($_SESSION['event_id'],"female"));?>
<?php $rowCriteria = json_decode(Criteria::findByCompetitionId($_SESSION['competition_id']));?>
<?php $rowScoresMale = json_decode(Scores::findByRows(array(
  "student_no" => $contestantsMale[0]->student_no,
  "competition_id" => $_SESSION['competition_id'],
  "judges_id" => $_SESSION['judges_id'],
)));?>
<?php $rowScoresFemale = json_decode(Scores::findByRows(array(
  "student_no" => $contestantsFemale[0]->student_no,
  "competition_id" => $_SESSION['competition_id'],
  "judges_id" => $_SESSION['judges_id'],
)));?>
<?php
if($rowScoresMale) $scoresMale = json_decode($rowScoresMale[0]->score); 
if($rowScoresFemale) $scoresFemale = json_decode($rowScoresMale[0]->score);

$rowCompetition = json_decode(Competition::findById($_SESSION['competition_id']));
?>

  <div class="container">
      <!-- <div style="height: 30px;"><input type="checkbox" class="switch-gender" name="gender" checked value="Mr" data-on-text="Mr" data-off-text="Ms"></div> -->
      <h1><?= ucwords($rowCompetition[0]->competition_name)?></h1>
      <div class="clearfix">
        <span class="pull-right">JUDGE: <?= $_SESSION['judge_name'];?></span>
      </div>

        <div class="clearfix">
          <div class="all-options">
            <button class="btn btn-primary btn-sm pull-right next">Next <i class="fa fa-arrow-right"></i></button>
            <button class="btn btn-primary btn-sm pull-left previous"><i class="fa fa-arrow-left"></i> Previous</button>
          </div>
        </div>
      <div class="row">
        <div class="center col-xs-6 mr-div" style="border-right:4px solid">
            <div class="text-center">
              <h3>MALE</h3>
            </div><br>
            <img style="height: 175px;"image-contestant src="<?php if($contestantsMale[0]->image == '1') echo '../images/male_default.svg'; else echo "../images/".$contestantsMale[0]->image;?>" alt="..." class="img-circle img-thumbnail">
              <!-- <div class="contestant-no" style="position: absolute;font-size: 40px;right: 50px;">#<span><?= $contestantsMale[0]->contestant_no;?></span></div> -->
              <select class="contestant-no-select" style="position: absolute;font-size: 40px;right: 50px;">
                  contestantsMale
                  <?php foreach ($contestantsMale as $key => $value):?>  
                    <option value="<?= $value->contestant_id;?>"><?= $value->contestant_no;?></option>
                  <?php endforeach;?>
              </select>
              <div style="position: absolute;font-size: 40px;right: 20px; top:80;">#</div>
              <div>
                <button type="button" class="btn btn-primary mT10 btn-sm names">
                  <?= ucwords($contestantsMale[0]->lastname) .', '. ucwords($contestantsMale[0]->firstname); ?>  <br>
                  <?= ucwords($contestantsMale[0]->year) .'-'. $contestantsMale[0]->section; ?>  
                </button>
              </div>
              <br>
            <form method="post" class="male-form">
              <input type="hidden" name="gender" value="<?= $contestantsMale[0]->gender; ?>">
              <input type="hidden" name="student_no" value="<?= $contestantsMale[0]->student_no; ?>">
              <input type="hidden" name="competition_id" value="<?= $_SESSION['competition_id']; ?>">
              <input type="hidden" name="contestant_id" value="<?= $contestantsMale[0]->contestant_id; ?>">
              <input type="hidden" name="event_id" value="<?= $contestantsMale[0]->event_id; ?>">
              <input type="hidden" name="scores_id" value="">
              <input type="hidden" name="judges_id" value="<?= $_SESSION['judges_id'];?>">      
              <input type="hidden" name="form" value="male_form">

              <?php foreach ($rowCriteria as $key => $value):?>  
                <br>
                <?= strtoupper($value->criteria_name); ?>(<?= $value->percentage; ?>%):
                <input score type="text" 
                  data-criteria="<?= strtolower(str_replace(' ', '_', $value->criteria_name));?>" 
                  data-percentage="<?= $value->percentage; ?>" 
                  class="form-control"
                  <?php if($rowScoresMale):?>
                   <?php foreach ($scoresMale as $keyScore => $valueScore): ?>
                    <?php if($keyScore == strtolower(str_replace(' ', '_', $value->criteria_name))):?>
                    value="<?=  $valueScore;?>"
                    <?php endif;?>
                  <?php endforeach;?>
                  <?php endif;?>
                  name="score[<?= strtolower(str_replace(' ', '_', $value->criteria_name));?>]" 
                  onkeydown="return isNumberKey(event)" required>
              <?php endforeach;?><br>

              <span class="lead">TOTAL SCORE: </span>
              <span class="label label-success total-score"><?php if($rowScoresMale) echo $rowScoresMale[0]->total_score; 
              else echo "0";?>%</span>
              <input id="total2" type="hidden" value="<?php if($rowScoresMale) echo $rowScoresMale[0]->total_score; 
              else echo "0";?>" name="total_score" class="mT10"><br><br>

              <input type="submit" name="submit" class="btn btn-danger btn-sm" value="SAVE">
            </form>

            <div class="clearfix">
              <div class="male-options">
                <button class="btn btn-primary btn-sm pull-right next">Next</button>
                <button class="btn btn-primary btn-sm pull-left previous">Previous</button>
              </div>
            </div>
        </div>

        <div class="center col-xs-6 ms-div">
            <!-- <img src="../images/female_default.svg" alt="..." class="img-circle img-thumbnail"> -->

            <div class="text-center">
              <h3>FEMALE</h3>
            </div><br>
            <img style="height: 175px;" image-contestant src="<?php if($contestantsFemale[0]->image == '1') echo '../images/female_default.svg'; else echo "../images/".$contestantsFemale[0]->image;?>" alt="..." class="img-circle img-thumbnail">
              <!-- <div class="contestant-no" style="position: absolute;font-size: 40px;right: 50px;">#<span><?= $contestantsFemale[0]->contestant_no;?></span></div> -->
              <select class="contestant-no-select" style="position: absolute;font-size: 40px;right: 50px;">
                  
                  <?php foreach ($contestantsFemale as $key => $value):?>  
                    <option value="<?= $value->contestant_id;?>"><?= $value->contestant_no;?></option>
                  <?php endforeach;?>
              </select>
              <div style="position: absolute;font-size: 40px;right: 20px; top:80;">#</div>

              <div>
                <button type="button" class="btn btn-primary mT10 btn-sm names">
                  <?= ucwords($contestantsFemale[0]->lastname) .', '. ucwords($contestantsFemale[0]->firstname); ?>  <br>
                  <?= ucwords($contestantsFemale[0]->year) .'-'. $contestantsFemale[0]->section; ?>  
                </button>
              </div>
              <br>
            <form method="post" class="female-form">
              <input type="hidden" name="gender" value="<?= $contestantsFemale[0]->gender; ?>">
              <input type="hidden" name="student_no" value="<?= $contestantsFemale[0]->student_no; ?>">
              <input type="hidden" name="competition_id" value="<?= $_SESSION['competition_id']; ?>">
              <input type="hidden" name="contestant_id" value="<?= $contestantsFemale[0]->contestant_id; ?>">
              <input type="hidden" name="event_id" value="<?= $contestantsFemale[0]->event_id; ?>">
              <input type="hidden" name="scores_id" value="">
              <input type="hidden" name="judges_id" value="<?= $_SESSION['judges_id'];?>">      
              <input type="hidden" name="form" value="female_form">

              <?php foreach ($rowCriteria as $key => $value):?>  
                <br>
                <?= strtoupper($value->criteria_name); ?>(<?= $value->percentage; ?>%):
                <input score type="text" 
                  data-criteria="<?= strtolower(str_replace(' ', '_', $value->criteria_name));?>" 
                  data-percentage="<?= $value->percentage; ?>" 
                  class="form-control"
                  <?php if($rowScoresFemale):?>
                   <?php foreach ($scoresFemale as $keyScore => $valueScore): ?>
                    <?php if($keyScore == strtolower(str_replace(' ', '_', $value->criteria_name))):?>
                    value="<?=  $valueScore;?>"
                    <?php endif;?>
                  <?php endforeach;?>
                  <?php endif;?>
                  name="score[<?= strtolower(str_replace(' ', '_', $value->criteria_name));?>]" 
                  onkeydown="return isNumberKey(event)" required>
              <?php endforeach;?><br>

              <span class="lead">TOTAL SCORE: </span>
              <span class="label label-success total-score"><?php if($rowScoresFemale) echo $rowScoresFemale[0]->total_score; 
              else echo "0";?>%</span>
              <input id="total2" type="hidden" value="<?php if($rowScoresFemale) echo $rowScoresFemale[0]->total_score; 
              else echo "0";?>" name="total_score" class="mT10"><br><br>

              <input type="submit" name="submit" class="btn btn-danger btn-sm" value="SAVE">
            </form>

            <div class="clearfix">
              <div class="female-options">
                <button class="btn btn-primary btn-sm pull-right next">Next</button>
                <button class="btn btn-primary btn-sm pull-left previous">Previous</button>
              </div>
            </div>
        </div>

      </div>
  </div>



<?php include('common/footer.php');?>
<script type="text/javascript">
  $(function() {
    $('.male-form').find('[score]').on('keyup', function(e){
      if(this.value > parseFloat(this.dataset.percentage)){
        e.preventDefault();
        $(this).val("");
      };
    });
    $('.male-form').find('[score]').on('input', function(e){
        $el = $(this.parentElement.parentElement).find("[score]");
        totalScore = 0;
        console.log("this");
        if(this.value <= parseFloat(this.dataset.percentage)){
          $($el).each(function() {
            if(this.value)
              totalScore += parseFloat(this.value);
              // totalScore += (parseFloat(this.value) * $(this).data('percentage') / 100);
          });
          $('.male-form').find("[name=total_score]").val(totalScore);
          $('.male-form').find(".total-score").html(totalScore+"%");
        }
        else{
          e.preventDefault();
          $(this).val(""); 
        }

    });
  });
</script>
<script type="text/javascript">
  $(function() {
    $('.female-form').find('[score]').on('keyup', function(e){
      if(this.value > parseFloat(this.dataset.percentage)){
        e.preventDefault();
        $(this).val("");
      };
    });
    $('.female-form').find('[score]').on('input', function(e){
        $el = $(this.parentElement.parentElement).find("[score]");
        totalScore = 0;
        console.log("this");
        if(this.value <= parseFloat(this.dataset.percentage)){
          $($el).each(function() {
            if(this.value)
              totalScore += parseFloat(this.value);
              // totalScore += (parseFloat(this.value) * $(this).data('percentage') / 100);
          });
          $('.female-form').find("[name=total_score]").val(totalScore);
          $('.female-form').find(".total-score").html(totalScore+"%");
        }
        else{
          e.preventDefault();
          $(this).val(""); 
        }

    });
  });
</script>
<script src="../lib/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".switch-gender").bootstrapSwitch();  
    $('.switch-gender').on('switchChange.bootstrapSwitch', function(event, state) {

      if(state === true){
        console.log('switch MR');
        $('.mr-div').removeClass('hide');
        $('.ms-div').addClass('hide');
      }else if(state === false){
        console.log('switch MS');

        $('.ms-div').removeClass('hide');
        $('.mr-div').addClass('hide');

      }

    });
    var changeValAjaxMale = function(arr){
      $(".loader").fadeIn('slow');
      $.ajax({
        url: '../includes/requests/request-scrores.php',
        type: 'POST',
        data: $.param(arr),
        dataType: 'json',
        success: function(results){
          if(results.score) {
              scores = $.parseJSON(results.score);
            $.map(scores, function(value, index) {
              $($maleForm).find("[data-criteria="+index+"]").val(value);
            });
          }else{
            $($maleForm.find('[data-criteria]')).each(function() {
              this.value= "";
            });
          }
          $.map(results, function(value, index) {
              $($maleForm).find("[name="+index+"]").val(value);
            });
          $($maleForm).find(".total-score").html(results.total_score+"%");
          $('.mr-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
          $('.mr-div').find('.contestant-no-select').val(results.contestant_id);
          $('.mr-div').find('[image-contestant]').attr('src', "../images/"+results.image);

          // console.log(results);

        },
        complete:function(){
          $(".loader").fadeOut('slow');
          //loader stop here.
        }
      });
    }
    var changeValAjaxFemale = function(arr){
      $(".loader").fadeIn('slow');
      $.ajax({
        url: '../includes/requests/request-scrores.php',
        type: 'POST',
        data: $.param(arr),
        dataType: 'json',
        success: function(results){
          if(results.score) {
              scores = $.parseJSON(results.score);
            $.map(scores, function(value, index) {
              $($femaleForm).find("[data-criteria="+index+"]").val(value);
            });
          }else{
            $($femaleForm.find('[data-criteria]')).each(function() {
              this.value= "";
            });
          }
          $.map(results, function(value, index) {
              $($femaleForm).find("[name="+index+"]").val(value);
            });
          $($femaleForm).find(".total-score").html(results.total_score+"%");
          $('.ms-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
          $('.ms-div').find('.contestant-no-select').val(results.contestant_id);
          $('.ms-div').find('[image-contestant]').attr('src', "../images/"+results.image);

          // console.log(results);

        },
        complete:function(){
          $(".loader").fadeOut('slow');
          //loader stop here.
        }
      });
    }

    $maleForm = $('.male-form');
    $femaleForm = $('.female-form');
    var nextValMale = function(){
      arr = {};

      $($maleForm.find('[name]')).each(function() {
        arr[this.name] = this.value;

      });
      arr["next"]= "next";
      changeValAjaxMale(arr);

     
    };

    var prevValMale = function(){
      arr = {};

      $($maleForm.find('[name]')).each(function() {
        arr[this.name] = this.value;

      });
      arr["prev"] = "prev"; 
      changeValAjaxMale(arr);
    };


    var nextValFemale = function(){
      arr = {};

      $($femaleForm.find('[name]')).each(function() {
        arr[this.name] = this.value;

      });
      arr["nextFemale"] = "nextFemale";
      changeValAjaxFemale(arr);

    };
      
    var prevValFemale = function(){
      arr = {};

      $($femaleForm.find('[name]')).each(function() {
        arr[this.name] = this.value;

      });
      
      arr["prevFemale"] = "prevFemale";
      changeValAjaxFemale(arr);
    };

    var submitFormMale = function(){
        $(".loader").fadeIn('slow');
        $.ajax({
          url: '../includes/requests/request-submit.php',
          type: 'POST',
          data: $maleForm.serialize(),
          dataType: 'json',
          success: function(results){
            console.log(results);
          },
          complete:function(){
            $(".loader").fadeOut('slow');
            //loader stop here.
          }
        });
    };
    var submitFormFemale = function(){
        $(".loader").fadeIn('slow');
        $.ajax({
          url: '../includes/requests/request-submit.php',
          type: 'POST',
          data: $femaleForm.serialize(),
          dataType: 'json',
          success: function(results){
            console.log(results);
          },
          complete:function(){
            $(".loader").fadeOut('slow');
            //loader stop here.
          }
        });
    };


    $('.all-options').find('.next').on('click', function(e){
      e.preventDefault();
      submitFormMale();
      nextValMale();
      submitFormFemale();
      nextValFemale();
      console.log('next male');
    });
    $('.all-options').find('.previous').on('click', function(e){
      e.preventDefault();
      submitFormMale();
      prevValMale();
      submitFormFemale();
      prevValFemale();
      console.log('previous male');
    });

    $('.male-options').find('.next').on('click', function(e){
      e.preventDefault();
      submitFormMale();
      nextValMale();
      console.log('next male');
    });
    $('.male-options').find('.previous').on('click', function(e){
      e.preventDefault();
      submitFormMale();
      prevValMale();
      console.log('previous male');
    });


    $('.female-options').find('.next').on('click', function(e){
      e.preventDefault();
      nextValFemale();
      submitFormFemale();
      console.log('next female');
    });
    $('.female-options').find('.previous').on('click', function(e){
      e.preventDefault();
      submitFormFemale();
      prevValFemale();
      console.log('previous female');
    });


      $maleForm.on('submit', function(e){
        e.preventDefault();
        submitFormMale();

      });

      $femaleForm.on('submit', function(e){
        e.preventDefault();
        submitFormFemale();
      });

      $(".mr-div").find('.contestant-no-select').on('input',function(){
          arr = {};
          arr['contestant_id'] = this.value;
          arr['competition_id'] = $(".mr-div").find("[name=competition_id]").val();
          arr['judges_id'] = $(".mr-div").find("[name=judges_id]").val();
            $(".loader").fadeIn('slow');
            $.ajax({
              url: '../includes/requests/request-no.php',
              type: 'POST',
              data: $.param(arr),
              dataType: 'json',
              success: function(results){
                if(results.score) {
                    scores = $.parseJSON(results.score);
                  $.map(scores, function(value, index) {
                    $($maleForm).find("[data-criteria="+index+"]").val(value);
                  });
                }else{
                  $($maleForm.find('[data-criteria]')).each(function() {
                    this.value= "";
                  });
                }
                $.map(results, function(value, index) {
                    $($maleForm).find("[name="+index+"]").val(value);
                  });
                $($maleForm).find(".total-score").html(results.total_score+"%");
                $('.mr-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
                $('.mr-div').find('.contestant-no-select').val(results.contestant_id);
                
                $('.mr-div').find('[image-contestant]').attr('src', "../images/"+results.image);
                console.log(results);
              },
              complete:function(){
                $(".loader").fadeOut('slow');
                //loader stop here.
              }
            });

      });
      $(".ms-div").find('.contestant-no-select').on('input',function(){
          arr = {};
          arr['contestant_id'] = this.value;
          arr['competition_id'] = $(".ms-div").find("[name=competition_id]").val();
          arr['judges_id'] = $(".ms-div").find("[name=judges_id]").val();
            $(".loader").fadeIn('slow');
            $.ajax({
              url: '../includes/requests/request-no.php',
              type: 'POST',
              data: $.param(arr),
              dataType: 'json',
              success: function(results){
                if(results.score) {
                    scores = $.parseJSON(results.score);
                  $.map(scores, function(value, index) {
                    $($femaleForm).find("[data-criteria="+index+"]").val(value);
                  });
                }else{
                  $($femaleForm.find('[data-criteria]')).each(function() {
                    this.value= "";
                  });
                }
                $.map(results, function(value, index) {
                    $($femaleForm).find("[name="+index+"]").val(value);
                  });
                $($femaleForm).find(".total-score").html(results.total_score+"%");
                $('.ms-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
                $('.ms-div').find('.contestant-no-select').val(results.contestant_id);

                $('.ms-div').find('[image-contestant]').attr('src', "../images/"+results.image);
                console.log(results);
              },
              complete:function(){
                $(".loader").fadeOut('slow');
                //loader stop here.
              }
            });

      });
      

    });//end 

    


</script>

<?php endif;?>
<?php endif;?>