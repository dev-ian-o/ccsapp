<div class="modal fade modal-add hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">ADD</h4>  
      </div>
      <div class="modal-body">
        <form method="post">

          <div class="control-group">
            <label class="control-label" for="event_id">Event Name</label>

            <div class="controls">
              <select class="form-control" name="event_id">
                  <?php foreach ($rowEvent as $key => $value):?>
                  <option <?php if($event_id == $value->event_id) echo "selected";?> value="<?= $value->event_id?>"><?= $value->event_name?></option>                 
                  <?php endforeach;?>
                </select>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="competition_id">Competition Name</label>

            <div class="controls">
              <select class="form-control" name="competition_id">
                  <?php foreach ($rowCompetition as $key => $value):?>
                  <option <?php if($competition_id == $value->competition_id) echo "selected";?> value="<?= $value->competition_id?>"><?= $value->competition_description?></option>                 
                  <?php endforeach;?>
                </select>
            </div>
          </div>
                

          <div class="control-group">
            <label class="control-label" for="main_criteria_name">Criteria Name</label>

            <div class="controls">
              <input class="span5" type="text" name="main_criteria_name" id="main_criteria_name" placeholder="Criteria Name">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="percentage">Percentage</label>

            <div class="controls">
              <input class="span5" type="text" name="percentage" id="percentage" placeholder="Percentage">
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="add" class="btn btn-primary" value="ADD">

          </form>
      </div>
    </div>
  </div>
</div>


<?php 
  if(isset($_POST['add'])){

    MainCriteria::add($_POST);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>