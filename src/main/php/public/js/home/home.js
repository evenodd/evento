$(document).ready(
	$.get('/bookings', function (data) {
		console.log(data);
		if (data.length == 0) {
			list = "You have no events :("
		}
		else  {
			list = JSON.stringify(data, null, 2);
		}
		$("#loadingPrompt").addClass("hidden");
		$("#bookingList").empty().append(list);
	})
);