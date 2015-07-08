Registration.Views.Registration = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-registration').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});