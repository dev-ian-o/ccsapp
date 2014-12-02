<div class="modal fade modal-edit hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
        <h4 class="modal-title" id="myModalLabel">EDIT</h4>  
      </div>
      <div class="modal-body">
        <form method="post">
          <input type="hidden" name="event_id" value="<?= $event_id; ?>">
          <div class="control-group">
            <label class="control-label" for="event_name">Event Name</label>

            <div class="controls">
              <input class="span8" type="text" name="event_name" id="event_name" placeholder="Event Name">
            </div>
          </div>

      </div>      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="edit" class="btn btn-primary" value="EDIT">

          </form>
      </div>
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
    Events::edit($_POST);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>