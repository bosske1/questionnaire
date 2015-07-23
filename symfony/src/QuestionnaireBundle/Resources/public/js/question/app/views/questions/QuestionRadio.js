Question.Views.QuestionRadio = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-question-radio').html());
    },

    render: function(question) {
        var html = this.template({question:question});
        this.$el.html(html);

        return this;
    }
});