const event = $("#event-details-container").data('event');
var guestsList;


$(document).ready(function() {
    var guests = [];
    $.get({
        url : "/eventos/" + event.id + "/rsvps",
        data : {
            sent : 0
        },
        success : function(res){
            
            res.forEach(function(guest){
                guests.push({
                    id : guest.id,
                    email : guest.email,
                    loading : false,
                });    
            });
            guestsList = new Vue({
                el : "#guests-list",
                data : {
                    guests : guests,
                    counter : guests.length,
                    errors: 0,
                    sending : false
                },
                methods : {
                    sendInvitations : function() {
                        $("#invitationModalHeading").text("Sending invitations ...");
                        this.sending=true;
                        vm = this;
                        this.guests.forEach(function(guest) {
                            guest.loading = true;
                            $.post({
                                url : '/rsvp/send/' + guest.id,
                                data : {
                                    _token : $("[name='csrf-token']").attr('content')
                                },
                                success : function(res) {
                                    $("#sendResults-" + guest.id)
                                        .css('color', 'green')
                                        .text('Invite Sent :)');
                                }
                            }).fail(function(res) {
                                $("#sendResults-" + guest.id)
                                    .css('color', 'red')
                                    .text('Error! Invitation not sent.');
                                vm.errors++;
                                vm.counter--;
                                guest.loading=false;
                            }).done(function(res) {
                                guest.loading = false;
                                vm.counter--;
                                if(vm.counter == 0)
                                    vm.sending = false;
                            });
                        });
                    }
                }
            });
        }
    });

   $("#sendInvitationsButton").click(function(e) {
        e.preventDefault();
        $("#invitationModal").modal("show");
   });
});