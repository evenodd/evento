alert("hello world");

function rsvpButton(){
		alert("you press");
		/*
        $.postEvent({
            url: '/rsvpResponse',
            data : 'fghj',
            success : function(res){
                console.log("hi ho success");
            }
        }).fail(function(res){
            console.log("hi ho failure");
        });
        */

        $.post("/storeRsvpResponse", {
        		cam: 'hoo',
        		jam: 'hii'
        	}
        );
    	
}