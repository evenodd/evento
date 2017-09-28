<template>
	<div class="nav nav-pills nav-stacked">
		<event-row 
			v-for="event in events" 
			v-bind:event="event"
			v-bind:show_guests="show_guests"
			v-bind:key="event.id">	
		</event-row>
	</div>
</template>

<script>
    export default {
        props: ['events','show_guests']
    }
</script>