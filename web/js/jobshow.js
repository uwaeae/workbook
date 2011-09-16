$(document).ready(function()
{
 $('li.newfileform ').hide();

$('label.newfilebutton').click(function(key)
	{
	$('li.newfilebutton ').slideUp("fast");
	$('li.newfileform ').slideDown("fast");
	 });




 $('.open_jobs_body').hide();

 
  $('.open_jobs_head').click(function(key)
	{
	if ($(".open_jobs_body").is(":hidden")) {
	$('.open_jobs_body').toggle("fast");
	} else {
    $('.open_jobs_body').toggle("slow");
	}
	});

$('.open_filiale_body').hide();


	  $('.open_filiale_head').click(function(key)
		{
		if ($(".open_filiale_body").is(":hidden")) {
		$('.open_filiale_body').toggle("fast");
		} else {
	    $('.open_filiale_body').toggle("slow");
		}
		});
});