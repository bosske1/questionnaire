Question.Views.Home = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-home').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});