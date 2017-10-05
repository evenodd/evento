<template>
	<div>
		<div class="col-md-0">
		    <input type="hidden" name="hidden">
		</div>
        <div v-for="(contact, i) in contacts">
	        <div :class="setGridColumn(i)">
		        <input 
                    :id="hashContact(contact.name)" 
                    :value="contact.value" 
                    :placeholder="contact.name"
                    v-model="contact.value"
                    class="form-control" 
                    type="text">
			</div>
		</div>
        <div class="col-md-6 col-md-offset-4">
		    <div class="input-group">
			    <input type="text" id="moreContactInput" class="form-control" placeholder="Type extra contacts here">
			    <span class="input-group-addon btn" v-on:click="addContact">Add contact field</span>
			</div>
	    </div>
	</div>
</template>

<script>
	export default {
        props: ['contacts'],
        methods : {
            // adds a new contact field in the contacts array
            addContact : function(e) {
            	// prevent the form submit
            	e.preventDefault();
            	// get new contact field
                var newContact = $("#moreContactInput").val();
                // Check field isnt empty, already an contact field or that the contacts are over the 10 field limit
                if(newContact != "" && $.inArray(newContact, this.getContactNames()) == -1 && this.contacts.length < 10)
                	//add new contact to array
                	this.contacts.push({
                        name : newContact,
                        value : ''
                    });
                //empty the more contact field
                var newContact = $("#moreContactInput").val("");
            },
            // The first field doen't need an offset
            setGridColumn : function(i) {
            	return i == 0 ?  "col-md-6" : "col-md-6 col-md-offset-4";
            },
            // Gonna use hashes for contact ids as dealing with spaces and punctuation
            // from user entered ids is a nightmare for css selectors :( rip
            hashContact : function(contact) {
            	return stringHash(contact);
            },
            getContactNames : function() {
                return this.contacts.map(c => c.name);
            }
        },
        watch : {
            contacts : {
                deep : true,
                handler : function() {
                    this.$emit('contacts_changed', this.contacts);
                }
            }
        }
    }
</script>