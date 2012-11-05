$(document).ready(function()
{
 $('#task_start_day').change(function() {
     changeItemBeginDate('day','task');
	});
 $('#task_start_month').change(function() {
     changeItemBeginDate('month','task');
	});
 $('#task_start_year').change(function() {
	changeItemBeginDate('year','task');
	});

 $('#task_end_day').change(function() {
	changeItemEndDate('day','task');
	});
 $('#task_end_month').change(function() {
	changeItemEndDate('month','task');
	});

$('#task_end_year').change(function() {
	changeItemEndDate('year','task');
	});
	

});

function init(){

}

function changeDate(item){


}



function changeItemBeginDate(item,modul){
	var begin = Number($('#' +modul +'_start_'+item+' option:selected').val());
    var end = Number($('#' +modul +'_end_'+item+' option:selected').val());

	if(begin >= end ){
        $('#' +modul +'_end_'+item).val(begin);
    }
}
function changeItemEndDate(item,modul){
    var begin = Number($('#' +modul +'_start_'+item+' option:selected').val());
    var end = Number($('#' +modul +'_end_'+item+' option:selected').val());

    if(end <= beginn ){
        $('#' +modul +'_start_'+item).val(end);
    }



}

function set_end_after_start(modul) {
	changeItemDate('day',modul);
	changeItemDate('month',modul);
	changeItemDate('year',modul);
}