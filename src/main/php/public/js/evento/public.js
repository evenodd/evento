function PublicEventListPanel(el) {
    this.vue = new Vue({
        el : el
    });
}

$(document).ready(function() {
    publicEventListPanel = new PublicEventListPanel("#publicEventList");
});