function Evento(data) {
    var id = data.id;

    this.getId = function() {
        return id;
    }
}

function Invite(id, email) {
    this.id = id;
    this.email = email;
    this.loading = false;
    this.resultPromptSelector = "#sendResults-" + this.id;
}

Invite.prototype.send = function(callbacks) {
    this.loading = true;
    var that = this;
    console.log(that);
    $.post({
        url : '/rsvp/send/' + this.id,
        data : {
            _token : $("[name='csrf-token']").attr('content')
        },
        success : function(res) {
            $(that.resultPromptSelector)
                .css('color', 'green')
                .text('Invite Sent :)');
            that.loading = false;
        }
    })
    .fail(function(res) {
        $(that.resultPromptSelector)
            .css('color', 'red')
            .text('Error! Invitation not sent.');
        that.loading = false;
        callbacks.fail(res);
    })
    .done(callbacks.done);
}

function InvitationModal(rsvps){
    this.errors = 0;
    this.sending =  false;
    this.invites = rsvps.map(function(rsvp) {
        return new Invite(rsvp.id, rsvp.email);
    });

    this.sendInvitations = function() {
        this.sending = true;
        var that = this;
        
        this.invites.forEach(function(invite) {
            invite.send({
                done : function(res) {
                    that.counter--;
                    if(that.counter == 0)
                        that.sending = false;
                },
                fail : function(res) {
                    that.errors++;
                    that.counter--;
                }
            });  
        });
    }

    this.vue= new Vue({
        el : "#invitationModal",
        data : {
            invites : this.invites,
            counter : this.invites.length,
            errors: 0,
            sending : false
        },
        methods : {
            sendInvitations : this.sendInvitations
        }
    });
}

InvitationModal.prototype.show = function() {
    $("#invitationModal").modal("show");
};

function GuestNb(el, event) {
    var that = this;
    this.event = event;
    this.guestNb = "...";
    this.vue = new Vue({
        el : el,
        data : {
            guestNb : this.guestNb
        }
    });

    this.set = function(nb) {
        that.vue.guestNb = nb;
    }

    this.displayError = function(errors){
        that.guestNb = '❌';
    }

    this.get({
        success : this.set,
        fail : this.displayError
    });
} 

GuestNb.prototype.get = function(callbacks) {
    $.get({
        url : '/eventos/' + this.event.getId() + '/nbOfGuests',
        success : callbacks.success
    })
    .fail(callbacks.fail);
};

$(document).ready(function() { 
    event = new Evento($("#event-details-container").data('event'));
    guestNb = new GuestNb("#guestNumber", event);
    //request rsvps and use data to render the invitationModal
    $.get({
        url : "/eventos/" + event.getId() + "/rsvps",
        data : {
            sent : 0
        },
    })
    .done(function(rsvps) {
        // init the invitationModal
        invitationModal = new InvitationModal(rsvps);
        // set the send invitation button to display the invitation modal
        $("#sendInvitationsButton").click(function(e) {
            e.preventDefault();
            invitationModal.show();
        });
    });


});