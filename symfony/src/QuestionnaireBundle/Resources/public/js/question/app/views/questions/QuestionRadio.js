Question.Views.QuestionRadio = Question.Views.Question.extend({

    type: 'radio',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-radio').html());
    },

    postRender: function() {
        var tickLength = this.getTickLength();
        initTimer(tickLength);
    },

    getNextQuestionId: function() {
        // Can be overwritten if needed:
        return this.question.nextQuestionId;
    }
});