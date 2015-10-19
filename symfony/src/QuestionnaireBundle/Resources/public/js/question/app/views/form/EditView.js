Question.Views.EditView = Backbone.View.extend({

    initialize: function(options) {
        this.options = options;
        this.template = _.template($('#tpl-edit-question').html());
        this.router = Question.mainRouter;
    },

    render: function(opts) {
        var html = this.template({question: opts.question});
        this.$el.html(html);
        return this;
    }
});