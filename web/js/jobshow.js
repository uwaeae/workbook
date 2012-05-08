$(document).ready(function()
{
 $('li.newfileform ').hide();

$('label.newfilebutton').click(function(key)
	{
	$('li.newfilebutton ').slideUp("fast");
	$('li.newfileform ').slideDown("fast");
	 });

$('div.job_assign_user_form ').hide();

$('label.job_assign_user_button').click(function(key)
    {
        $('div.job_assign_user_button ').slideUp (function(){
            $('div.job_assign_user_form ').slideDown();

        });
    });



 $('.open_jobs_body').hide();

 
  $('.open_jobs_head').click(function(key){
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