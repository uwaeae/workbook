$(document).ready(function()
{
	if(moment($('#task_end').val(),'YYYY-MM-DD HH:mm:ss', true).isValid()) {
		$('#task_end').val(moment($('#task_end').val(), 'YYYY-MM-DD HH:mm').format('DD.MM.YYYY HH:mm'));
	}
	if(moment($('#task_start').val(),'YYYY-MM-DD HH:mm:ss', true).isValid()){
		$('#task_start').val(moment($('#task_start').val(),'YYYY-MM-DD HH:mm').format('DD.MM.YYYY HH:mm'));
	}


 $('#task_start').datetimepicker({
	 format:'d.m.Y H:i',
	 lang:'de',
	 step:15,
	 dayOfWeekStart: 1,
	 showApplyButton: true,
	 onSelectDate:function( ct ){


		 //console.log( moment(ct).format());
		 //console.log(moment($('#task_end').val(),'DD.MM.YYYY HH:mm').format());
		 //console.log()
		 if(moment(ct).isAfter(moment($('#task_end').val(),'DD.MM.YYYY HH:mm')) ){
			 $('#task_end').val(moment(ct).add(8, 'h').format('DD.MM.YYYY HH:mm'));
		 }


	 }


 });


	$('#task_end').datetimepicker({
			format:'d.m.Y H:i',
			lang:'de',
			step:15,
			dayOfWeekStart: 1,
		showApplyButton: true,
		onSelectDate:function( ct ){

			if(moment(ct).isBefore(moment($('#task_start').val(),'DD.MM.YYYY HH:mm')) ){
				$('#task_start').val(moment(ct).subtract(8, 'h').format('DD.MM.YYYY HH:mm'));
			}


		}

		});
 /*$('#task_start_day').change(function() {
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
	*/

});
Date.daysBetween = function( date1, date2 ) {
	//Get 1 day in milliseconds
	var one_day=1000*60*60*24;

	// Convert both dates to milliseconds
	var date1_ms = date1.getTime();
	var date2_ms = date2.getTime();

	// Calculate the difference in milliseconds
	var difference_ms = date2_ms - date1_ms;

	// Convert back to days and return
	return Math.round(difference_ms/one_day);
}




/*
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
	*/