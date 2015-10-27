Question.Views.QuestionEdit = Backbone.View.extend({

    initialize: function(options) {
        this.options = options;
        this.template = _.template($('#tpl-question-edit').html());
        this.router = Question.mainRouter;
    },

    render: function(opts) {
        var html = this.template({question: opts.question});
        this.$el.html(html);
        return this;
    }
});