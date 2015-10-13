Question.Views.QuestionFeedback = Question.Views.Question.extend({

    type: 'feedback',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-feedback').html());
    }
});