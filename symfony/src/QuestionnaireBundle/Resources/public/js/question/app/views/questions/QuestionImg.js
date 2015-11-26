Question.Views.QuestionImg = Question.Views.Question.extend({

    type: 'img',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-img').html());
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