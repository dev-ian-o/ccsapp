<div class="modal fade modal-edit hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">EDIT</h4>  
      </div>

      <form action ="<?=$_SERVER['PHP_SELF']?>" method = "post" enctype="multipart/form-data">
      <div class="modal-body">

          <input type="hidden" name="image_id" value="">
          <div class="control-group">
            <label class="control-label" for="competition_id">Image:</label>
            <!-- <input type="file" name="file"> -->
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
    
    $name = $_FILES['file']['name'];
    $name = time()."_".$name;
    if ( move_uploaded_file ( $_FILES["file"]["tmp_name"] , 
         "../images/". $name) ){

        $_POST['image_name'] = $name;
        Images::edit($_POST);
        echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
    }
    else echo "<script>alert('Error!');location.href='".$_SERVER['PHP_SELF']."';</script>";

  }
?>