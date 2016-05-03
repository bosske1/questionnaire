Question.Views.QuestionSelect = Question.Views.Question.extend({

    type: 'select',
    errorMessage: null,
    selectId: 'answer-select',

    initialize: function() {
        this.template= _.template($('#tpl-question-select').html());
    },

    postRender: function() {
        var tickLength = this.getTickLength();
        initTimer(tickLength);
    },

    getNextQuestionId: function() {
        // Can be overwritten if needed:
        var selectedPotentialAnswer = this.getSelectedAnswer();

        if (typeof selectedPotentialAnswer != 'undefined'
            && selectedPotentialAnswer.nextQuestionId != null
            && selectedPotentialAnswer.nextQuestionId != 0
            && !isNaN(selectedPotentialAnswer.nextQuestionId)) {
            return selectedPotentialAnswer.nextQuestionId;
        }

        return this.question.nextQuestionId;
    },

    getSelectedAnswer: function() {
        var me = this;
        var answerId = $('#' + this.selectId).val();

        return _.find(me.question.potentialAnswers, function(potentialAnswer){ return potentialAnswer.id == answerId; });
    },

    getValue: function() {
        var selectedPotentialAnswer = this.getSelectedAnswer();

        var answer = '';

        if (typeof selectedPotentialAnswer != 'undefined') {
            answer =  selectedPotentialAnswer.answer;
        }

        return answer;
    }
});