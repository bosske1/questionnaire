Login.Views.Login = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-login').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});