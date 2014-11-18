//  always edit init!
$(document).ready(function(){
	$("#form-add-row-lesson").on('submit', function(e){
		e.preventDefault();
		form = "#form-add-row-lesson";
		initAddLesson("form-add-row-lesson");	
		return false;
	});

});



function initAddLesson(form){
	console.log("fetching");
	$(".loader").fadeIn('fast');
	form = $('#'+form);
	console.log(form.serialize());
	$.ajax({
		url: '../includes/requests/request-scores.php',
		type: 'POST',
		data: form.serialize(),
		dataType: 'json',
		success: function(results){
			var vars = results;
			console.log(vars);
		},
		complete:function(){
			$(".loader").fadeOut('slow');
			//loader stop here.
		}
	});
}
