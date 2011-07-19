$(document).ready(function()
{
 $('.open_jobs_body').hide();
 
  $('.open_jobs_head').click(function(key)
	{
	if ($(".open_jobs_body").is(":hidden")) {
	$('.open_jobs_body').slideDown("slow");
	} else {
    $('.open_jobs_body').slideUp("slow");
	}
	});
});