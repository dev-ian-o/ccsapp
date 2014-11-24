<div class="modal fade modal-delete hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">DELETE</h4>  
      </div>
      <div class="modal-body">
        <form method="post">

          <input type="hidden" name="competition_id" value="">
          <input type="hidden" name="criteria_id" value="">
          <input type="hidden" name="image" value="1">
          <div class="control-group">
            <label class="control-label" for="criteria_name">Criteria Name</label>

            <div class="controls">
              <input class="span5" type="text" name="criteria_name" id="criteria_name" placeholder="Criteria Name" disabled="">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="percentage">Percentage</label>

            <div class="controls">
              <input class="span5" type="text" name="percentage" id="percentage" placeholder="Percentage" disabled="">
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
    Criteria::delete($_POST['criteria_id']);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>