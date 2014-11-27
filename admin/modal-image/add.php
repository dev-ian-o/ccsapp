<div class="modal fade modal-add hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></a>
        <h4 class="modal-title" id="myModalLabel">ADD</h4>  
      </div>
      <div class="modal-body">

        <Form action ="<?=$_SERVER['PHP_SELF']?>" method = "post" enctype="multipart/form-data">

          <div class="control-group">
            <label class="control-label" for="competition_id">Image:</label>
            <input type="file" name="file">
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
    
    $name = $_FILES['file']['name'];
    $name = strtolower(str_replace(' ', '_', $name));
    $name = time()."_".$name;
    if ( move_uploaded_file ( $_FILES["file"]["tmp_name"] , 
         "../images/". $name) ){
        $_POST['image_name'] = $name;
        Images::add($_POST);
        echo "<script>alert('Success!');location.href='".$_SERVER['PHP_SELF']."';</script>";
    }
    else echo "<script>alert('Error!');location.href='".$_SERVER['PHP_SELF']."';</script>";

  }
?>