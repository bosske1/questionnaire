Question.Views.AddView = Backbone.View.extend({

    initialize: function() {
        this.template = _.template($('#tpl-add-question').html());
        this.router = Question.mainRouter;
    },

    render: function(question) {
        var html = this.template();
        this.$el.html(html);
        return this;
    }
});