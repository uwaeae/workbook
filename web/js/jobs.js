$(document).ready(function()
{
	
init();
  


});

function init(){


    setInterval(function()
    {
       $('.content').load('/job');
    }, 300000);


$('div.job_type_head_0').click(function(key)
	{
      //var body = $(this).parent().find('.job_type_0_body').visible();

        $(this).parent().find('.job_type_body').fadeOut("slow").load('/job/table/type/0' ).fadeIn("slow");
      //$(this).parent().find('.job_type_body').load('/job/table/type/0' ); //.slideToggle('slow');
        var refreshId = setInterval(function()
        {
            $(this).parent().find('.job_type_body').fadeOut("slow").load('/job/table/type/0' ).fadeIn("slow");
        }, 10000);
        //$(this).parent().find('.job_type_body').toggle();
	}); 

 $('div.job_type_head_1').click(function(key)
	{
        $(this).parent().find('.job_type_body').load('/job/table/type/1' );
        setInterval(function()
        {
        $(this).parent().find('.job_type_body').load('/job/table/type/1' ); //.slideToggle('slow');
        //$(this).parent().find('.job_type_body').toggle();
        }, 10000);

	});

    $('div.job_type_head_3').click(function(key)
    {

        $(this).parent().find('.job_type_body').load('/job/table/type/3' ); //.slideToggle('slow');
       // $(this).parent().find('.job_type_body').toggle();

    });
    $('div.job_type_head_4').click(function(key)
    {

        $(this).parent().find('.job_type_body').load('/job/table/type/4' ); //.slideToggle('slow');
        //$(this).parent().find('.job_type_body').toggle();

    });
}


var auto_refresh = setInterval(
function()
{

 	$('#jobs').fadeOut('fast').load('/job .job_type_body').fadeIn();
	$('#jobs').fadeOut('fast').load('/job .job_type_head').fadeIn();



}, 500000);