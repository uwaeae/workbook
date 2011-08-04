$(document).ready(function()
{

 
  $('.job_type_1_head').click(function(key)
	{
	
	$('.job_type_1_body').load('job/open',function() {
		 // $('.job_type_2_body').fadeIn();
		});
		
	
	});
$('.job_type_2_head').click(function(key)
	{
		
	$('.job_type_2_body').load('job/sheduled',	function() {
			 // $('.job_type_2_body').show();
			});
	});
$('.job_type_3_head').click(function(key)
	{
	$('.job_type_3_body').fadeToggle();
	});
$('.job_type_4_head').click(function(key)
	{
	$('.job_type_4_body').fadeToggle();
	});
  


});