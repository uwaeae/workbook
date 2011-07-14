$(document).ready(function()
{
 $('.job_type_1_body').hide();
$('.job_type_2_body').hide();
$('.job_type_3_body').hide();
$('.job_type_4_body').hide();
 
  $('.job_type_1_head').click(function(key)
	{
	$('.job_type_1_body').fadeToggle();
	});
$('.job_type_2_head').click(function(key)
	{
	$('.job_type_2_body').fadeToggle();
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