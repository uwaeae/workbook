$(document).ready(function()
{
	
init();
  


});

function init(){
	
	$('.job_type_0_body').hide();
	$('.job_type_1_body').hide();
	$('.job_type_2_body').hide();
	$('.job_type_3_body').hide();
	$('.job_type_4_body').hide();
	


$('div.job_type_0_head').click(function(key)
	{
	 $('.job_type_0_body').slideToggle('slow');
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
	$(' .job_type_3_body ').slideToggle("slow");
	});
$('.job_type_4_head ').click(function(key)
	{
	$('.job_type_4_body ').slideToggle("slow");
	});
}


var auto_refresh = setInterval(
function()
{

 	$('#jobs').fadeOut('fast').load('/job .job_type_body').fadeIn();
	$('#jobs').fadeOut('fast').load('/job .job_type_head').fadeIn();



}, 500000);