$(document).ready(function()
{
	$('.payroll_nav .radio_list input:radio').change(requestFilter); 
});

var requestFilter =  function(){
		var $form = $('form'); 
		$( " #payroll " ).fadeTo("fast", 0.1);
		
		 $.post( $form.attr('action'), $form.serialize(), function(data){
			
			var content = $( data ).find(" .payroll ");
		    $( " #payroll " ).empty().append( content );
		     $( " #payroll " ).fadeTo("fast", 1);
		 
			});
}