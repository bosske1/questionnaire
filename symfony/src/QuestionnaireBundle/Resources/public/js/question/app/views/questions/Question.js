Question.Views.Question = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-question-input').html());
    },

    render: function(question) {
        var html = this.template({question:question});
        this.$el.html(html);

        return this;
    }
});