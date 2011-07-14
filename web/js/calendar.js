$(document).ready(function()
{
 $('.cal_open_jobs_body').hide();
 $('.cal_filter_item').hide();
 
  $('.cal_open_jobs_head').click(function(key)
	{
	$('.cal_open_jobs_body').fadeToggle();
	});
$('.cal_filter_opener').click(function(key)
	{
	$('.cal_filter_item').fadeToggle();	
	});


  
});