Question.Views.QuestionGroupJobs = Question.Views.Question.extend({

    type: 'groupJobs',
    errorMessage: null,

    decider: 'FR11900',

    initialize: function() {
        this.template= _.template($('#tpl-question-group_jobs').html());
    },

    isValid: function(){
        return true;
    },

    postRender: function() {
        var me = this;
        me.enableNext();
        //var tickLength = this.getTickLength();
        //initTimer(tickLength);

        this.initTimer();
    },
    
    submitAnswer: function() {
        var questions = this.$('select');
        var answers = {};

        _.each(questions, function(questionSelect) {
            answers[$(questionSelect).attr('id')] = $(questionSelect).val();
        });

        $.post('/question/submitMultiAnswer', {questionId: this.question.id, answers: answers, type: this.type});

    },

    getNextQuestionId: function() {
        // Can be overwritten if needed:
        var deciderAnswer = this.$('#FR11900').val();

        var selectedPotentialAnswer = this.getSelectedAnswer(deciderAnswer);

        if (typeof selectedPotentialAnswer != 'undefined'
            && selectedPotentialAnswer.nextQuestionId != null
            && selectedPotentialAnswer.nextQuestionId != 0
            && !isNaN(selectedPotentialAnswer.nextQuestionId)) {
            return selectedPotentialAnswer.nextQuestionId;
        }

        return this.question.nextQuestionId;
    },

    getSelectedAnswer: function(selectedPotentialAnswer) {
        var me = this;
        return _.find(me.question.potentialAnswers, function(potentialAnswer){ return potentialAnswer.realAnswer == selectedPotentialAnswer; });
    }
});