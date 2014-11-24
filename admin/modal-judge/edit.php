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

          <input type="hidden" name="competition_id" value="">
          <input type="hidden" name="criteria_id" value="">
          <input type="hidden" name="judges_id" value="">
          <div class="control-group">
            <label class="control-label" for="name">Judges Name</label>

            <div class="controls">
              <input class="span5" type="text" name="name" id="name" placeholder="Judges Name">
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
  $(function() {
    $('.action-buttons').find('.edit').on('click', function(){
        console.log(this);
        $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('.modal-edit').find('[name='+this.name+']').val(this.value);
        });

    });
  });
</script>


<?php 
  if(isset($_POST['edit'])){
    Judges::edit($_POST);
    echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
  }
?>