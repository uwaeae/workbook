$(document).ready(function()
{
 $('.open_jobs_body').hide();
 $('.cal_filter_body').hide();
 
  $('.open_jobs_head').click(function(key)
	{
	if ($(".open_jobs_body").is(":hidden")) {
	$('.open_jobs_body').slideDown("slow");
	} else {
    $('.open_jobs_body').slideUp("slow");
	}
	});
	
$('.cal_filter_opener').click(function(key)
	{

	if ($(".cal_filter_body").is(":hidden")) {
	$('.cal_filter_body').slideDown("slow");
	} else {
    $('.cal_filter_body').slideUp("slow");
	}
	
	});

/*$('.filtertypes .toggle:checkbox ').each(function(){
	var $toggle = $(this);
	var $checkboxes = $('.filtertypes .checkbox_list input:checkbox');
	$toggle.change(function(){
		if(this.checked) {
			$checkboxes.attr('checked','checked');
		} else {
			$checkboxes.removeAttr('checked');
		}
		requestFilter();
	});
	
	$checkboxes.change(function(){
		if(this.checked) {
			if($checkboxes.length == $checkboxes.filter(':checked').length)
			 $toggle.attr('checked','checked');
		}else{
			$toggle.removeAttr('checked')
		}
		requestFilter();
		
	}).eq(0).trigger('change');
	
});

$('.filterusers .toggle:checkbox ').each(function(){
	var $toggle = $(this);
	var $checkboxes = $('.filterusers .checkbox_list input:checkbox');
	$toggle.change(function(){
		if(this.checked) {
			$checkboxes.attr('checked','checked');
		} else {
			$checkboxes.removeAttr('checked');
		}
		requestFilter();
		
	});
	
	$checkboxes.change(function(){
		if(this.checked) {
			if($checkboxes.length == $checkboxes.filter(':checked').length)
			 $toggle.attr('checked','checked');
			
			
			
		}else {
			$toggle.removeAttr('checked')
		}
		requestFilter();
		
	}).eq(0).trigger('change');
	
});*/

$('.filterusers .checkbox_list input:checkbox').change(requestFilter); 
$('.filtertypes .checkbox_list input:checkbox').change(requestFilter); 

  
});

var requestFilter =  function(){
		var $form = $('form'); 
		$( " #calendar " ).fadeTo("fast", 0.1);
		
		 $.post( $form.attr('action'), $form.serialize(), function(data){
			
			var content = $( data ).find(" .calendar ");
		    $( " #calendar " ).empty().append( content );
		     $( " #calendar " ).fadeTo("fast", 1);
		 
			});
}


