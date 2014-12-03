<div class="modal fade modal-edit hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">EDIT</h4>  
      </div>
      <form method="post">
      <div class="modal-body">
        <form method="post">
          <input type="hidden" name="main_criteria_id" value="">
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
        <input type="submit" name="edit" class="btn btn-primary" value="EDIT">

          
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        console.log(this);
        $('#table-competition').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('.modal-edit').find('[name='+this.name+']').val(this.value);
        });

    });
  });
</script>


<?php 
  if(isset($_POST['edit'])){
    MainCriteria::edit($_POST);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>