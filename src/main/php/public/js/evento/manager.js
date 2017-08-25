$(document).ready(
	$.get('/eventos', function (res) {
		console.log(res);
		var events = ['Birthday Party at UTS','Post Assignment Party','Serious Business Meetup 203','Wedding at Stephanoes'];
		$('.evento-select2')
			.select2({
				placeholder : "Enter event here",
				data : events
			})
			.on('select2:select', function(e){
				console.log(e);
				$.get('/eventos'/*/' + e.currentTarget.value*/, function (res) {
					console.log(res);
					emails = [
						Math.random().toString(36).substring(7) + "@gmail.com",
						Math.random().toString(36).substring(7) + "@gmail.com",
						Math.random().toString(36).substring(7) + "@gmail.com",
						Math.random().toString(36).substring(7) + "@gmail.com",
						Math.random().toString(36).substring(7) + "@gmail.com",
						Math.random().toString(36).substring(7) + "@gmail.com"
					];
					console.log(emails);
					guestSelect = $('.guest-select2').select2({
						placeholder : "Enter guests email here",
						tags: true,
						tokenSeparators: [',', ' '],
						disabled : false,
						data : emails
					});
					// $('.guest-select2').prop("disabled", false);
					guestSelect.val(emails).trigger("change");
					// $('.guest-select2').select2('data').push(emails);
					// $('.guest-select2').select2("data", emails, true); // true means that select2 should be refreshed
				});


			});
	}),
	guestSelect = $('.guest-select2').select2({
		placeholder : "Enter guests email here",
		tags: true,
		tokenSeparators: [',', ' '],
		disabled : true,
	})
);