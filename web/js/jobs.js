$(document).ready(function()
{
	$('.job_type_0_body ').hide();
	$('.job_type_1_body ').hide();
	$('.job_type_2_body ').hide();
	$('.job_type_3_body ').hide();
	$('.job_type_4_body ').hide();
	$('.job_type_5_body ').hide();
	$('.job_type_0_head #loader').hide();
	$('.job_type_1_head #loader').hide();
	$('.job_type_2_head #loader').hide();
	$('.job_type_3_head #loader').hide();
	$('.job_type_4_head #loader').hide();
	$('.job_type_5_head #loader').hide();

$('div.job_type_0_head').click(function(key)
	{
	 $('.job_type_0_body').slideToggle(700);
	}); 

 $('div.job_type_1_head').click(function(key)
	{
 		$('.job_type_1_body').slideToggle(700);
	});
$('.job_type_2_head').click(function(key)
	{
		$('.job_type_2_body').slideToggle();
	});
$('div.job_type_3_head').click(function(key)
	{
	$('div.job_type_3_body ').slideToggle("slow");
	});
$('.job_type_4_head ').click(function(key)
	{
	$('.job_type_4_body tr').slideToggle("slow");
	});
  


});