Question.Views.QuestionSelect = Question.Views.Question.extend({

    type: 'select',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-select').html());
    }
});