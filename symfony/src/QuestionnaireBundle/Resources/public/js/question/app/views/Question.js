Question.Views.Question = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-question').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});