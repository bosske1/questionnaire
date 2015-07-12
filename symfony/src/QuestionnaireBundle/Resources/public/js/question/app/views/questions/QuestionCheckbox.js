Question.Views.QuestionCheckbox = Backbone.View.extend({

    initialize: function() {
        this.template= _.template($('#tpl-question-checkbox').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});