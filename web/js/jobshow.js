$(document).ready(function () {

	if(moment($('#job_end').val(),'YYYY-MM-DD HH:mm:ss', true).isValid()) {
		$('#job_end').val(moment($('#job_end').val(), 'YYYY-MM-DD HH:mm').format('DD.MM.YYYY HH:mm'));
	}
	if(moment($('#job_start').val(),'YYYY-MM-DD HH:mm:ss', true).isValid()){
		$('#job_start').val(moment($('#job_start').val(),'YYYY-MM-DD HH:mm').format('DD.MM.YYYY HH:mm'));
	}




	$('#job_start').datetimepicker({
		format: 'd.m.Y H:i',
		lang: 'de',
		step: 15,
		showApplyButton: true,
		dayOfWeekStart: 1,
		onSelectDate: function (ct) {
			//console.log( moment(ct).format());
			//console.log(moment($('#job_end').val(),'DD.MM.YYYY HH:mm').format());
			//console.log()
			if (moment(ct).isAfter(moment($('#job_end').val(), 'DD.MM.YYYY HH:mm'))) {
				$('#job_end').val(moment(ct).add(1, 'd').format('DD.MM.YYYY HH:mm'));
			}
		}
	});

	$('#job_end').datetimepicker({
		format: 'd.m.Y H:i',
		lang: 'de',
		step: 15,
		showApplyButton: true,
		dayOfWeekStart: 1,
		onSelectDate: function (ct) {
			if (moment(ct).isBefore(moment($('#job_start').val(), 'DD.MM.YYYY HH:mm'))) {
				$('#job_start').val(moment(ct).subtract(1, 'd').format('DD.MM.YYYY HH:mm'));
			}
		}
	});




	$('li.newfileform ').hide();

	$('label.newfilebutton').click(function (key) {
		$('li.newfilebutton ').slideUp("fast");
		$('li.newfileform ').slideDown("fast");
	});

	$('div.job_assign_user_form ').hide();

	$('label.job_assign_user_button').click(function (key) {
		$('div.job_assign_user_button ').slideUp(function () {
			$('div.job_assign_user_form ').slideDown();

		});
	});


	$('.open_jobs_body').hide();


	$('.open_jobs_head').click(function (key) {
		//  $('.open_jobs_body').slideUp('fast');
		$(this).parent().find('div.open_jobs_body').slideToggle('fast');
		//$('.open_jobs_body').set


	});


});

/*
 $('.open_filiale_body').hide();


 $('.open_filiale_head').click(function(key)
 {
 $('.open_jobs_body').hide();
 $('.jobsold_body').hide();
 if ($(".open_filiale_body").is(":hidden")) {
 $('.open_filiale_body').toggle("fast");
 } else {
 $('.open_filiale_body').toggle("slow");
 }
 });
 $('.jobsold_body').hide();


 $('.jobsold_head').click(function(key)
 {
 $('.open_filiale_body').hide();
 $('.open_jobs_body').hide();
 if ($(".jobsold_body").is(":hidden")) {
 $('.jobsold_body').toggle("fast");
 } else {
 $('.jobsold_body').toggle("slow");
 }
 });
 });
 */