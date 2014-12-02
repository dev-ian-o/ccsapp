<div class="modal fade modal-add hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">ADD</h4>  
      </div>
      <div class="modal-body">
        <form method="post">
          <!-- <input type="hidden" name="event_id" value="<?= $event_id; ?>"> -->
          <div class="control-group">
            <label class="control-label" for="event_name">Event Name</label>

            <div class="controls">
              <input class="span8" type="text" name="event_name" id="event_name" placeholder="Event Name">
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
    Events::add($_POST);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>