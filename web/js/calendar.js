$(document).ready(function()
{
 $('.cal_open_jobs_body').hide();
 $('.cal_filter_item').hide();
 
  $('.cal_open_jobs_head').click(function(key)
	{
	if ($(".cal_open_jobs_body").is(":hidden")) {
	$('.cal_open_jobs_body').slideDown("slow");
	} else {
    $('.cal_open_jobs_body').slideUp("slow");
	}
	
	
	
	
	});
$('.cal_filter_opener').click(function(key)
	{
	$('.cal_filter_item').fadeToggle();
	});


  
});