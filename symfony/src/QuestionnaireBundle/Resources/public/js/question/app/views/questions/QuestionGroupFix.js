Question.Views.QuestionGroupFix = Question.Views.Question.extend({

    type: 'groupFix',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-group_fixed').html());
    },

    isValid: function(){
        return true;
    },

    postRender: function() {
        var tickLength = this.getTickLength();
        initTimer(tickLength);
    },
    
    submitAnswer: function() {
        var questions = this.$('select');
        var answers = {};

        _.each(questions, function(questionSelect) {
            answers[$(questionSelect).attr('id')] = $(questionSelect).val();
        });

        $.post('/question/submitMultiAnswer', {questionId: this.question.id, answers: answers, type: this.type});

    }
});