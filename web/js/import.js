$(document).ready(function()
{
  $('#loader').hide();
 
// $('input#submit').click(function(event)

 $("#inputForm").submit(function(e){
	       e.preventDefault();
		
		$('#loader').show();
		$('#order').fadeOut();
		
		var datafield = $(":input").serializeArray();
		var url =  $("#inputForm").attr('action');
		$.post(
		   url,
		   datafield,
		   function(html){
		     $('#loader').fadeOut();
			$("#zuordnung").append(" - Ergebniss")
			 $("#results").hide().append(html).slideDown();
		   });
		
   });
	
});


