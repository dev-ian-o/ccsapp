<div class="modal fade modal-delete hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">DELETE</h4>  
      </div>
      <div class="modal-body">
        <form method="post">
          <input type="hidden" name="competition_id" value="2">
          <input type="hidden" name="contestant_id" value="1">
          <input type="hidden" name="image" value="1">
          <div class="control-group">
            <label class="control-label" for="contestant_no">Contestant No</label>

            <div class="controls">
              <input class="span5" type="text" name="contestant_no" id="contestant_no" placeholder="Contestant No" disabled="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="student_no">Student No</label>

            <div class="controls">
              <input class="span5" type="text" name="student_no" id="student_no" placeholder="Student No" disabled="">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="lastname">Last Name</label>

            <div class="controls">
              <input class="span5" type="text" name="lastname" id="lastname" placeholder="Last Name" disabled="">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="firstname">First Name</label>

            <div class="controls">
              <input class="span5" type="text" name="firstname" id="firstname" placeholder="First Name" disabled="">
            </div>
          </div>


          <div class="control-group">
            <label class="control-label" for="gender">Gender</label>

            <div class="controls">
              <select id="gender" name="gender" type="text" class="form-control span5" disabled="">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="year">Year</label>

            <div class="controls">
              <select id="year" name="year" type="text" class="form-control span5" disabled="">
                
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
              </select>
            </div>
          </div>


          <div class="control-group">
            <label class="control-label" for="section">Section</label>

            <div class="controls">
              <select id="section" name="section" type="text" class="form-control span5" disabled="">
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
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="course">Course</label>

            <div class="controls">
              <select id="course" name="course" type="text" class="form-control span5" disabled="">
                <option value="BSITSM">BS ITSM</option>
                <option value="BSCSAD">BS CSAD</option>
                <option value="BSCNA">BS CNA</option>
              </select>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="delete" class="btn btn-primary" value="Delete">

          </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(function() {
    $('.action-buttons').find('.delete').on('click', function(){
        console.log(this);
        $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('.modal-delete').find('[name='+this.name+']').val(this.value);
        });

    });
  });
</script>

<?php 
  if(isset($_POST['delete'])){
    ScreeningRegistration::delete($_POST['contestant_id']);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>