$(document).ready(function () {

	init();


	$("#autocomplete_store").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: "/frontend_dev.php/job/findstore/action",
				dataType: "json",

				success: function (data) {
					response($.map(data, function (item) {


						var label = item;
						if (item) {
							label += ' ' + item.vorname;
						}
						if (item.companyName) {
							label += ' (' + item.companyName + ')';
						}


						return {
							label: label,
							data: item
						}
					}));
				}
			});
		},
		minLength: 2,
		select: function (event, ui) {
			//debugger;
			var url = $(this).data('redirect');
			window.location.href = url + ui.item.data.id + '/show';


		}
	});
	/*
	 .autocomplete('%s', jQuery.extend({}, {
	 dataType: 'json',
	 parse:    function(data) {
	 var parsed = [];
	 for (key in data) {
	 parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
	 }
	 return parsed;
	 }
	 }, %s))
	 .result(function(event, data) { jQuery("#%s").val(data[1]); });*/


	function init() {

		$('div.job_type_body').hide();
		$('div.job_type2_body').hide();


		setInterval(function () {
			$('.content').load('/job');
		}, 300000);


		$('div.job_type_head_0').click(function (key) {
			//var body = $(this).parent().find('.job_type_0_body').visible();

			var text = $(this).html();
			$(this).html(text + " Loading ...");
			$(this).parent().find('.job_type_body:hidden').load('/job/table/type/0', function () {
				$(this).slideDown('fast');
			});
			$(this).parent().find('.job_type_body:visible').slideUp('fast');
			$(this).html(text );

		});

		$('div.job_type_head_1').click(function (key) {
			//$('div.job_type_head_1').parent().find('.job_type_body:hidden').load('/job/table/type/1' ).show();
			$(this).parent().find('.job_type_body:hidden').load('/job/table/type/1', function () {
				$(this).slideDown('fast');
			});

			$(this).parent().find('.job_type_body:visible').slideUp('fast');

		});


		$('div.job_type_head_2').click(function (key) {


			$(this).parent().find('.job_type_body').slideToggle('fast');

		});


		$('div.job_type_head_3').click(function (key) {

			$(this).parent().find('.job_type_body:hidden').load('/job/table/type/3', function () {
				$(this).slideDown('fast');
			});
			$(this).parent().find('.job_type_body:visible').slideUp('fast');

		});
		$('div.job_type_head_4').click(function (key) {

			$(this).parent().find('.job_type_body:hidden').load('/job/table/type/4', function () {
				$(this).slideDown('fast');
			});
			$(this).parent().find('.job_type_body:visible').slideUp('fast')

		});
	}


	var auto_refresh = setInterval(
		function () {

			$('#jobs').fadeOut('fast').load('/job .job_type_body').fadeIn();


		}, 500000);
});