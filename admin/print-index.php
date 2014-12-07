<?php if(isset($_GET['let-me-in'])):?>
	<?php if($_GET['let-me-in'] === "ianolinares"):?>
<?php include 'common/header.php';?>
<?php require_once '../includes/Classes/Scores.php';?>
<?php require_once '../includes/Classes/Judges.php';?>
<?php require_once '../includes/Classes/Competition.php';?>
<?php 

	$rowCompetition = json_decode(Competition::fetch());
	$rowJudges = json_decode(Judges::fetch());
	if (isset($_GET['id_competition'])) 
		$competition_id = $_GET['id_competition'];
	else
		$competition_id = "2";

	if (isset($_GET['id_judges'])) 
		$judges_id = $_GET['id_judges'];
	else
		$judges_id = "1";

	$rowMale = json_decode(Scores::checkTallyJudges("male",$competition_id,$judges_id));
	$rowFemale = json_decode(Scores::checkTallyJudges("female",$competition_id,$judges_id));
?>
	<body>
		<?php //include 'common/nav.php';?>

		<div class="page-header position-relative">

			<button type="button" id="print-btn">Print</button>
			Judge: <select class="form-control" name="sort_by_judges">
				<option value="1">choose</option>
				<?php foreach ($rowJudges as $key => $value):?>
				<option <?php  if($judges_id == $value->judges_id){ echo"selected"; $judge_name = $value->name;}?> value="<?= $value->judges_id?>"><?= $value->name?></option>									
				<?php endforeach;?>
			</select>

			Category: <select class="form-control" name="sort_by_competition">
				<option value="2">choose</option>
				<?php foreach ($rowCompetition as $key => $value):?>
				<option <?php  if($competition_id == $value->competition_id){ echo"selected"; $category = $value->competition_description; }?> value="<?= $value->competition_id?>"><?= $value->competition_description?></option>									
				<?php endforeach;?>
			</select>	
			<div class="row-fluid" id="printDiv">
		
					<h3 class="text-center">
						College Of Computer Science<br>
						Computer Society<br>
						Mr. and Ms. CCS 2015: Parisian Night 2015
					</h3>
					<hr/>
					<h5><b>
						Judge:
						<?= strtoupper($judge_name); ?>
						</b><br>

						Category:
						<?= strtoupper($category); ?>
					</h5>
					<div class="table-header clearfix"  style="margin-top:-15px">
						Mr. CCS Scores
					</div>

					<table id="" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="width:5%;">#</th>
								<th style="width:45%">Contestant Name</th>
								<th style="width:15%">Year & Section</th>
								<th style="width:30%">Score per criteria</th>
								<th style="width:5%">Total</th>
							</tr>
						</thead>

						<tbody>
							<?php $a = 1; foreach ($rowMale as $key => $value):?>
							<tr>
								<td><?= $value->contestant_no; ?></td>
								<td><?= $value->firstname; ?> <?= $value->lastname; ?></td>
								<td><?= $value->year; ?>-<?= $value->section; ?></td>
								<td><?= $value->score; ?></td>
								<td style="background-color:yellow;"><b><?= $value->total_score; ?></b></td>
							</tr>
							<?php endforeach;?>

						</tbody>
					</table>
					<div class="table-header clearfix" style="margin-top:-20px">
						Ms.CCS Scores
					</div>

					<table id="" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th style="width:5%;">#</th>
								<th style="width:45%">Contestant Name</th>
								<th style="width:15%">Year & Section</th>
								<th style="width:30%">Score per criteria</th>
								<th style="width:5%">Total</th>
							</tr>
						</thead>

						<tbody>
							<?php $a = 1; foreach ($rowFemale as $key => $value):?>
							<tr>
								<td><?= $value->contestant_no; ?></td>
								<td><?= $value->firstname; ?> <?= $value->lastname; ?></td>
								<td><?= $value->year; ?>-<?= $value->section; ?></td>
								<td><?= $value->score; ?></td>
								<td style="background-color:yellow;"><b><?= $value->total_score; ?></b></td>
							</tr>
							<?php endforeach;?>

						</tbody>
					</table>
					<div style="position:relative;margin-top:70px;">
						<div style="position:absolute;right:0px;bottom:0px; font-size:17px;">
							_______________________________________<br>
							&nbsp;&nbsp;&nbsp;Judge's Signature over Printed Name
						</div>
					</div>
					<div><?= date('Y/m/d h:m:s');?></div>

			</div>
		</div><!--/.page-header-->

		

<?php include 'common/footer.php'; ?>
<script>
	$(function() {
		$('#table-competition').dataTable();
	});
</script>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
<script type="text/javascript">
  $(function() {
    $('[name=sort_by]').on('input', function(){
    	// console.log(this);       
        location.href = "<?= $_SERVER['PHP_SELF'] ?>" + "?id=" +  $('[name=sort_by]').val()+"&let-me-in=ianolinares";
    });
  });
</script>

<script type="text/javascript">
  $(function() {
    $('[name=sort_by_judges]').on('change', function(){
    	console.log(this);     
        location.href = "<?= $_SERVER['PHP_SELF'] ?>" + "?id_competition=" +  $('[name=sort_by_competition]').val()+ "&id_judges=" +  $('[name=sort_by_judges]').val()+"&let-me-in=ianolinares";
    });
  });
</script>

<script type="text/javascript">
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'Print', 'height=1000,width=1000');
        mywindow.document.write('<html><head><title>Print</title> ');


        /*optional stylesheet*/ 
        mywindow.document.write('<link href="../lib/assets/css/bootstrap.min.css" rel="stylesheet" />');
        mywindow.document.write('<style>hr{margin:0px;}.table td{padding:2px;}table{font-size:12px;}body{ background: White; color: Black; } h5{line-height:20px;}h3{ color: Black;line-height:30px;}</style></head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }
    $(document).ready(function(){
      // PrintElem("#printDiv");

      $("#print-btn").click(function(){
        PrintElem("#printDiv");
      });
    });


</script>
	<?php endif;?>
<?php endif;?>

