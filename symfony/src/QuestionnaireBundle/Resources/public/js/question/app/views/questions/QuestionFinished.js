Question.Views.QuestionFinished = Question.Views.Question.extend({

    type: 'finished',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-finished').html());
    }
});