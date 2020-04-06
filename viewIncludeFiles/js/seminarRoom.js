(function ($) {

	$(document).ready(function () {

		var getCmControl = [];
		var getHolidayList = [];
		var getTimeZoneList = [];
		var startDay = 0;
		var endMonth = 0;

		$.ajax({
			url: '../../classes/Common/getCmControl.php',
		}).done((rtn) => {
			getCmControl = JSON.parse(rtn);
			startDay = getCmControl['reservable_day_after'];
			endMonth = getCmControl['seminar_room_reservable_month'];

			$.ajax({
			    url: '../../classes/seminarRoomGetClosingDayList.php',
			    type: 'POST',
			    data: {
			        startDay: startDay,
			        endMonth: endMonth,
			    }
			}).done((rtn) => {
			    getHolidayList = JSON.parse(rtn);
				$('#datepicker').datepicker({
					minDate: '+' + startDay + 'd',
					maxDate: '+' + endMonth + 'm',
					beforeShowDay: function (day) {
						var yymmdd = $.datepicker.formatDate('yy-mm-dd', day);
						return [(getHolidayList.indexOf(yymmdd) == -1), ''];
					},
					onSelect: function(dateText, inst) {
						$("#time tr").remove();
						$('#use_day').text(dateText);
						$.ajax({
						    url: '../../classes/seminarRoomGetTimeZoneList.php',
						    type: 'POST',
						    data: {
						        targetDay: dateText
						    }
						}).done((rtn) => {
							getTimeZoneList = JSON.parse(rtn);
/*
							$.each(getTimeZoneList,function(i, val) {
								$("#time").append($('<tr><td><input id="timezoneradio" type="radio" >'));
								$("#time").append($('<label class="button">' + val['start_time'] + '～' + val['end_time'] + '</label></td></tr>'));
							});
*/
						}).fail((rtn) => {
							return false;
						});
					}
				});
			}).fail((rtn) => {
				return false;
			});

		}).fail((rtn) => {
			return false;
		});

	});
})(jQuery);