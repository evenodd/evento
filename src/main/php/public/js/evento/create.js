$(document).ready(
	$('.guest-select2').select2({
		placeholder : "Enter guests email here",
		tags: true,
		tokenSeparators: [',', ' '],
		data : $.get('user/emails', function (res) {
			console.log(res);
			return res;
		})
	})
);