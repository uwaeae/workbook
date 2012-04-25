$(document).ready(function()
{
	
init();
  


});

function init(){

    $('div.job_type_body').hide();


    setInterval(function()
    {
       $('.content').load('/job');
    }, 300000);


$('div.job_type_head_0').click(function(key)
	{
      //var body = $(this).parent().find('.job_type_0_body').visible();


        $(this).parent().find('.job_type_body:hidden').load('/job/table/type/0' ,function(){
            $(this).show(); });
        $(this).parent().find('.job_type_body:visible').hide();
	}); 

 $('div.job_type_head_1').click(function(key)
	{
        //$('div.job_type_head_1').parent().find('.job_type_body:hidden').load('/job/table/type/1' ).show();
        $(this).parent().find('.job_type_body:hidden').load('/job/table/type/1',function(){
                $(this).show(); });

        $(this).parent().find('.job_type_body:visible').hide();

	});


    $('div.job_type_head_2').click(function(key)
    {


        $(this).parent().find('.job_type_body').toggle();

    });




    $('div.job_type_head_3').click(function(key)
    {

        $(this).parent().find('.job_type_body:hidden').load('/job/table/type/3' ,function(){
            $(this).show(); });
        $(this).parent().find('.job_type_body:visible').hide();

    });
    $('div.job_type_head_4').click(function(key)
    {

        $(this).parent().find('.job_type_body:hidden').load('/job/table/type/4' ,function(){
            $(this).show(); });
        $(this).parent().find('.job_type_body:visible').hide

    });
}


var auto_refresh = setInterval(
function()
{

 	$('#jobs').fadeOut('fast').load('/job .job_type_body').fadeIn();
	$('#jobs').fadeOut('fast').load('/job .job_type_head').fadeIn();



}, 500000);