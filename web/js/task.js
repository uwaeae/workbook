$(document).ready(function()
{
 $('#task_start_day').change(function() {
	changeItemDate('day','task');
	});
 $('#task_start_month').change(function() {
	changeItemDate('month','task');
	});
	
$('#task_start_year').change(function() {
	changeItemDate('year','task');
	});
	

  
});

function changeItemDate(item,modul){
	var itemvalue = $('#' +modul +'_start_'+item+' option:selected').val();
	if(itemvalue> $('#' +modul +'_end_'+item).val() ) $('#' +modul +'_end_'+item).val(itemvalue);
}

function set_end_after_start(modul) {
	changeItemDate('day',modul);
	changeItemDate('month',modul);
	changeItemDate('year',modul);
}