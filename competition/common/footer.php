
    <div class="animated rotateIn infinite loader glyphicon glyphicon-refresh"></div>  
    <!-- JavaScript -->
    <script src="../lib/js/jquery-1.10.2.js"></script>
    <script src="../lib/js/bootstrap.min.js"></script>
    <script src="../lib/js/underscore.min.js"></script>
</body>
</html>
<script type="text/javascript">
  $(window).load(function() {
      $(".loader").fadeOut("slow");
  });

  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
      && (charCode < 48 || charCode > 57) && charCode != 190 && charCode != 110 && (charCode > 105 || charCode < 96))
       return false;
    return true;
  }

  
</script>