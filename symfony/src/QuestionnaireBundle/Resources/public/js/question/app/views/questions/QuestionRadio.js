Question.Views.QuestionRadio = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-question-radio').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});