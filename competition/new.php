<link href="../lib/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
<?php  session_start();?>
<?php if(!isset($_SESSION['competition_id']))echo "<script>alert('Login first');location.href='login-judge.php';</script>"; ?>
<?php if(!isset($_SESSION['judges_id']))echo "<script>location.href='login-judge.php';</script>"; ?>
<?php include('common/header.php');?>
<?php include('../includes/classes/Criteria.php');?>
<?php include('../includes/classes/ScreeningRegistration.php');?>
<?php include('../includes/classes/Judges.php');?>
<?php include('../includes/classes/Scores.php');?>
<?php $contestants = json_decode(ScreeningRegistration::findByCompetitionId($_SESSION['competition_id']));?>
<?php $rowCriteria = json_decode(Criteria::findByCompetitionId($_SESSION['competition_id']));?>
<?php $rowScores = json_decode(Scores::fetch());?>
<?php
// echo "<pre>";
// print_r($contestants);
// print_r($rowCriteria);
?>

  <div class="container">
      <div style="height: 30px;"><input type="checkbox" class="switch-gender" name="gender" checked value="Mr" data-on-text="Mr" data-off-text="Ms"></div>
      <div class="center mr-div">
          <img src="../images/male_default.svg" alt="..." class="img-circle img-thumbnail">
            <div class="male-no" style="position: absolute;font-size: 40px;right: 20px;">#<span>1</span></div>
            <div>
              <button type="button" class="btn btn-primary mT10 btn-sm names">
                <?= ucwords($contestants[0]->lastname) .', '. ucwords($contestants[0]->firstname); ?>  <br>
                <?= ucwords($contestants[0]->year) .'-'. $contestants[0]->section; ?>  
              </button>
            </div>
            <br>
          <form method="post" class="male-form">
            <input type="hidden" name="gender" value="<?= $contestants[0]->gender; ?>">
            <input type="hidden" name="student_no" value="<?= $contestants[0]->student_no; ?>">
            <input type="hidden" name="competition_id" value="<?= $contestants[0]->competition_id; ?>">
            <input type="hidden" name="contestant_id" value="<?= $contestants[0]->contestant_id; ?>">
            <input type="hidden" name="scores_id" value="">
            <input type="hidden" name="judges_id" value="<?= $_SESSION['judges_id'];?>">      
            <input type="hidden" name="judges_id" value="<?= $_SESSION['judges_id'];?>">
            <input type="hidden" name="form" value="male_form">


            <?php foreach ($rowCriteria as $key => $value):?>  
              <br>
              <?= strtoupper($value->criteria_name); ?>(<?= $value->percentage; ?>%):
              <input score type="text" data-percentage="<?= $value->percentage; ?>" class="form-control" value="" name="score[<?= str_replace(' ', '_', $value->criteria_name);?>]" onkeydown="return isNumberKey(event)" required>
            <?php endforeach;?><br>

            <span class="lead">TOTAL SCORE: </span>
            <span class="label label-success total-score">0%</span>
            <input id="total2" type="hidden" value="0" name="total_score" class="mT10"><br><br>

            <input type="submit" name="submit" class="btn btn-danger btn-sm">
          </form>

          <div class="clearfix">
            <div class="male-options">
              <button class="btn btn-primary btn-sm pull-right next">Next</button>
              <button class="btn btn-primary btn-sm pull-left previous">Previous</button>
            </div>
          </div>
      </div>
      <div class="center ms-div hide">
      </div>
  </div>



<?php include('common/footer.php');?>
<script type="text/javascript">
  $(function() {
    $('.male-form').find('[score]').on('keyup', function(e){
      if(this.value > 100){
        e.preventDefault();
        $(this).val("");
      };
    });
    $('.male-form').find('[score]').on('input', function(e){
        $el = $(this.parentElement.parentElement).find("[score]");
        totalScore = 0;
        if(this.value <= 100){
          $($el).each(function() {
            if(this.value)
              totalScore += (parseFloat(this.value) * $(this).data('percentage') / 100);
              // totalScore += parseFloat(this.value) * $(this).data('percentage');
          });
          $('.male-form').find("[name=total_score]").val(totalScore);
          $('.male-form').find(".total-score").html(totalScore+"%");
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
        $('.mr-div').find('.img-thumbnail').attr('src','../images/male_default.svg')
        $('.mr-div').removeClass('hide');
        $('.ms-div').addClass('hide');
      }else if(state === false){
        console.log('switch MS');
        $('.ms-div').find('.img-thumbnail').attr('src','../images/female_default.svg')
        $('.ms-div').removeClass('hide');
        $('.mr-div').addClass('hide');

      }

    });
    $maleForm = $('.male-form');
    $femaleForm = $('.female-form');
    var nextValMale = function(){
      arr = {};
      arr["gender"] = $maleForm.find('[name=gender]').val();
      arr["competition_id"] = $maleForm.find('[name=competition_id]').val();
      arr["contestant_id"] = $maleForm.find('[name=contestant_id]').val();
      arr["student_no"] = $maleForm.find('[name=student_no]').val();      
      arr["judges_id"] = $maleForm.find('[name=judges_id]').val();      
      arr["next"] = "next";      


        $(".loader").fadeIn('slow');
      $.ajax({
        url: '../includes/requests/request-scrores.php',
        type: 'POST',
        data: $.param(arr),
        dataType: 'json',
        success: function(results){
          if(results.score) {
            scores = $.parseJSON(results.score);
            $maleForm.find('#talent-range').val(scores.brain); 
            $maleForm.find('#talent-input').val(scores.brain); 
            $maleForm.find('#presentation-range').val(scores.beauty); 
            $maleForm.find('#presentation-input').val(scores.beauty);
            
          }else{
            $maleForm.find('#talent-range').val(""); 
            $maleForm.find('#talent-input').val(""); 
            $maleForm.find('#presentation-range').val(""); 
            $maleForm.find('#presentation-input').val("");
          }
          $maleForm.find('[name=gender]').val(results.gender);
          $maleForm.find('[name=competition_id]').val(results.competition_id);
          $maleForm.find('[name=contestant_id]').val(results.contestant_id);
          $('.mr-div').find('.male-no').find('span').html(results.contestant_no);
          $maleForm.find('[name=student_no]').val(results.student_no); 
          $maleForm.find('[name=student_no]').val(results.student_no); 
          $('.mr-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
          console.log(results);

        },
        complete:function(){
          $(".loader").fadeOut('slow');
          //loader stop here.
        }
      });
    };

    var prevValMale = function(){
      arr = {};
      arr["gender"] = $maleForm.find('[name=gender]').val();
      arr["competition_id"] = $maleForm.find('[name=competition_id]').val();
      arr["contestant_id"] = $maleForm.find('[name=contestant_id]').val();
      arr["student_no"] = $maleForm.find('[name=student_no]').val();      
      arr["judges_id"] = $maleForm.find('[name=judges_id]').val();  
      arr["prev"] = "prev";      

        $(".loader").fadeIn('slow');
      $.ajax({
        url: '../includes/requests/request-scrores.php',
        type: 'POST',
        data: $.param(arr),
        dataType: 'json',
        success: function(results){
          if(results.score){

            scores = $.parseJSON(results.score); 

            $maleForm.find('#talent-range').val(scores.brain); 
            $maleForm.find('#talent-input').val(scores.brain); 
            $maleForm.find('#presentation-range').val(scores.beauty); 
            $maleForm.find('#presentation-input').val(scores.beauty);
          }else{
            $maleForm.find('#talent-range').val(""); 
            $maleForm.find('#talent-input').val(""); 
            $maleForm.find('#presentation-range').val(""); 
            $maleForm.find('#presentation-input').val("");
          }

          $maleForm.find('[name=gender]').val(results.gender);
          $maleForm.find('[name=competition_id]').val(results.competition_id);
          $maleForm.find('[name=contestant_id]').val(results.contestant_id);
          $('.mr-div').find('.male-no').find('span').html(results.contestant_no);
          $maleForm.find('[name=student_no]').val(results.student_no); 

          $('.mr-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
          console.log(results);
        },
        complete:function(){
          $(".loader").fadeOut('slow');
          //loader stop here.
        }
      });
    };


    var nextValFemale = function(){
      arr = {};
      arr["gender"] = $femaleForm.find('[name=gender]').val();
      arr["competition_id"] = $femaleForm.find('[name=competition_id]').val();
      arr["contestant_id"] = $femaleForm.find('[name=contestant_id]').val();
      arr["student_no"] = $femaleForm.find('[name=student_no]').val();      
      arr["judges_id"] = $femaleForm.find('[name=judges_id]').val();      
      arr["nextFemale"] = "nextFemale";      


        $(".loader").fadeIn('slow');
      $.ajax({
        url: '../includes/requests/request-scrores.php',
        type: 'POST',
        data: $.param(arr),
        dataType: 'json',
        success: function(results){
          if(results.score) {
            scores = $.parseJSON(results.score);
            $femaleForm.find('#talent-range2').val(scores.brain); 
            $femaleForm.find('#talent-input2').val(scores.brain); 
            $femaleForm.find('#presentation-range2').val(scores.beauty); 
            $femaleForm.find('#presentation-input2').val(scores.beauty);
          }else{

            $femaleForm.find('#talent-range2').val(""); 
            $femaleForm.find('#talent-input2').val(""); 
            $femaleForm.find('#presentation-range2').val(""); 
            $femaleForm.find('#presentation-input2').val("");
          }
          $femaleForm.find('[name=gender]').val(results.gender);
          $femaleForm.find('[name=competition_id]').val(results.competition_id);
          $femaleForm.find('[name=contestant_id]').val(results.contestant_id);
          $('.ms-div').find('.female-no').find('span').html(results.contestant_no);
          $femaleForm.find('[name=student_no]').val(results.student_no); 
          
          $('.ms-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
          console.log(results);

        },
        complete:function(){
          $(".loader").fadeOut('slow');
          //loader stop here.
        }
      });
    };
    var prevValFemale = function(){
      arr = {};
      arr["gender"] = $femaleForm.find('[name=gender]').val();
      arr["competition_id"] = $femaleForm.find('[name=competition_id]').val();
      arr["contestant_id"] = $femaleForm.find('[name=contestant_id]').val();
      arr["student_no"] = $femaleForm.find('[name=student_no]').val();      
      arr["judges_id"] = $femaleForm.find('[name=judges_id]').val();      
      arr["prevFemale"] = "nextFemale";      


        $(".loader").fadeIn('slow');
      $.ajax({
        url: '../includes/requests/request-scrores.php',
        type: 'POST',
        data: $.param(arr),
        dataType: 'json',
        success: function(results){
          if(results.score) {
            scores = $.parseJSON(results.score);
            $femaleForm.find('#talent-range2').val(scores.brain); 
            $femaleForm.find('#talent-input2').val(scores.brain); 
            $femaleForm.find('#presentation-range2').val(scores.beauty); 
            $femaleForm.find('#presentation-input2').val(scores.beauty);
          }else{

            $femaleForm.find('#talent-range2').val(""); 
            $femaleForm.find('#talent-input2').val(""); 
            $femaleForm.find('#presentation-range2').val(""); 
            $femaleForm.find('#presentation-input2').val("");
          }
          $femaleForm.find('[name=gender]').val(results.gender);
          $femaleForm.find('[name=competition_id]').val(results.competition_id);
          $femaleForm.find('[name=contestant_id]').val(results.contestant_id);
          $('.ms-div').find('.female-no').find('span').html(results.contestant_no);
          $femaleForm.find('[name=student_no]').val(results.student_no); 
          
          $('.ms-div').find('.names').html(results.lastname+', '+results.firstname+'<br>'+results.year+'-'+results.section);
          console.log(results);

        },
        complete:function(){
          $(".loader").fadeOut('slow');
          //loader stop here.
        }
      });
    };




    $('.male-options').find('.next').on('click', function(e){
      e.preventDefault();
      nextValMale();
      console.log('next male');
    });
    $('.male-options').find('.previous').on('click', function(e){
      e.preventDefault();
      prevValMale();
      console.log('previous male');
    });


    $('.female-options').find('.next').on('click', function(e){
      e.preventDefault();
      nextValFemale();
      console.log('next female');
    });
    $('.female-options').find('.previous').on('click', function(e){
      e.preventDefault();
      prevValFemale();
      console.log('previous female');
    });



      $maleForm.on('submit', function(e){
        e.preventDefault();
          $(".loader").fadeIn('slow');
        $.ajax({
          url: '../includes/requests/request-scrores.php',
          type: 'POST',
          data: $maleForm.serialize(),
          // dataType: 'json',
          success: function(results){
            console.log(results);
          },
          complete:function(){
            $(".loader").fadeOut('slow');
            //loader stop here.
          }
        });

      });

      $femaleForm.on('submit', function(e){
        e.preventDefault();

          $(".loader").fadeIn('slow');
        $.ajax({
          url: '../includes/requests/request-scrores.php',
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
        console.log('submit');
      });






    });//end 




</script>

