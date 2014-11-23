<div class="modal fade modal-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">ADD</h4>  
      </div>
      <div class="modal-body">
        <form method="post">
          <input type="hidden" name="competition_id" value="">
          <div class="control-group">
            <label class="control-label" for="competition_name">Competition Name</label>

            <div class="controls">
              <input class="span8" type="text" name="competition_name" id="competition_name" placeholder="Competition Name">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="competition_description">Competition Description</label>

            <div class="controls">
              <input class="span8" type="text" name="competition_description" id="competition_description" placeholder="Competition Name">
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
    Competition::add($_POST);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>