
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

  $(function() {

      minus = 5;
      var c1_input = "#talent-input";
      var c1_range = "#talent-range";
      
      var c2_input = "#presentation-input";
      var c2_range = "#presentation-range";
      total = 50;
      function add(){
          c1 = parseFloat($(c1_input).val());
          c2 = parseFloat($(c2_input).val());
          total = (c1 + c2).toFixed(2);

          console.log(c1 == NaN);
          if($('#overtime').is(':checked')){console.log("checked"); total -= minus;}
          $("#total").val(total);
          $(".total-score").html(total+"%");
          return parseFloat(total);
      }

      $("#overtime").on('change',function(){
        add();
      });


      $(c1_input).bind('input',function(e){ 
        num = e.target.value;
        if(num != null && num <= 30 && num > 0) {
          $(c1_range).val(e.target.value);
        }else{
          $(c1_range).val(15);
          $(c1_input).val("");
        }
        add();
      });
      $(c1_input).on('blur',function(e){ 
        console.log("sd");
        if(e.target.value == ""){
          $(c1_input).val(15.0);
        }
        add();
      });
      $(c1_range).on('input',function(e){
        $(c1_input).val(e.target.value);
        add();
      });



      

      $(c2_input).bind('input',function(e){ 
        num = e.target.value;
        if(num != null && num <= 70 && num > 0) {
          $(c2_range).val(e.target.value);
        }else{
          $(c2_range).val(35);
          $(c2_input).val("");
        }
        add();
      });
      $(c2_input).on('blur',function(e){ 
        console.log("sd");
        if(e.target.value == ""){
          $(c2_input).val(35.0);
        }
        add();
      });
      $(c2_range).on('input',function(e){
        $(c2_input).val(e.target.value);
        add();
      });

  });
  
  $(function() {

      var c1_input2 = "#talent-input2";
      var c1_range2 = "#talent-range2";
      
      var c2_input2 = "#presentation-input2";
      var c2_range2 = "#presentation-range2";
      total = 50;
      function add2(){
          c12 = parseFloat($(c1_input2).val());
          c22 = parseFloat($(c2_input2).val());
          total2 = (c12 + c22).toFixed(2);

          console.log(c12 == NaN);
          if($('#overtime2').is(':checked')){console.log("checked"); total -= minus;}
          $('.ms-div').find("#total2").val(total2);
          $('.ms-div').find(".total-score2").html(total2+"%");
          return parseFloat(total);
      }



      $(c1_input2).bind('input',function(e){ 
        num = e.target.value;
        if(num != null && num <= 30 && num > 0) {
          $(c1_range2).val(e.target.value);
        }else{
          $(c1_range2).val(15);
          $(c1_input2).val("");
        }
        add2();
      });
      $(c1_input2).on('blur',function(e){ 
        console.log("sd");
        if(e.target.value == ""){
          $(c1_input2).val(15.0);
        }
        add2();
      });
      $(c1_range2).on('input',function(e){
        $(c1_input2).val(e.target.value);
        add2();
      });



      

      $(c2_input2).bind('input',function(e){ 
        num = e.target.value;
        if(num != null && num <= 70 && num > 0) {
          $(c2_range2).val(e.target.value);
        }else{
          $(c2_range2).val(35);
          $(c2_input2).val("");
        }
        add2();
      });
      $(c2_input2).on('blur',function(e){ 
        console.log("sd");
        if(e.target.value == ""){
          $(c2_input2).val(35.0);
        }
        add2();
      });
      $(c2_range2).on('input',function(e){
        $(c2_input2).val(e.target.value);
        add2();
      });

  });


  
</script>