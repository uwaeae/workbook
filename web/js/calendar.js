$(document).ready(function(){
    $('.open_jobs_body').hide();
    $('.cal_filter_body').hide();
    $('.open_jobs_head').click(function(key)
    {
        $(".open_jobs_body").slideToggle();
    });

    $('.cal_filter_opener').click(function(key)
    {
        $(".cal_filter_body").slideToggle();
    });




    init();
});




var init = function(){

    $('table.cal_table_medium  td.cal_entry  ').click(click_content);
    $('table.cal_table_user  td.cal_entry  ').click(click_content);
    $('.filterusers .checkbox_list input:checkbox').change(requestFilter);
    $('.filtertypes .checkbox_list input:checkbox').change(requestFilter);
  
};

var requestFilter =  function(){
		var $form = $('form'); 
		$( " #calendar " ).fadeTo("fast", 0.1);
		
		 $.post( $form.attr('action'), $form.serialize(), function(data){
			
			var content = $( data ).find(" .calendar ");
		    $( " #calendar " ).empty().append( content );
		     $( " #calendar " ).fadeTo("fast", 1);
		      init();

			});
};

var click_content = function(){
    //$(this).unbind('click');
    $('div.cal_entry_content_over').hide();
    $(this).find('div.cal_entry_content_over').show();
    $(this).click(function(){
        $(this).find('div.cal_entry_content_over').hide();
        $(this).click(click_content);
    })

    };
