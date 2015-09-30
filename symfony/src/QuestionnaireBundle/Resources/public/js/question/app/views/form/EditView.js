Question.Views.EditView = Backbone.View.extend({

    initialize: function() {
        this.template = _.template($('#tpl-edit-question').html());
        this.router = Question.mainRouter;
    },

    render: function(question) {
        var html = this.template({question:question});
        this.$el.html(html);
        return this;
    }
});