Question.Views.QuestionGroupFix = Question.Views.Question.extend({

    type: 'groupFix',
    errorMessage: null,

    fixAnswers: ['FR11601', 'FR11602', 'FR11603', 'FR11604', 'FR11605', 'FR11606'],

    initialize: function() {
        this.template= _.template($('#tpl-question-group_fixed').html());
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

        _.each(this.fixAnswers, function(fixAnswer) {
            answers[fixAnswer] = $("input:radio[name ='" + fixAnswer + "']:checked").val();
        });

        $.post('/question/submitMultiAnswer', {questionId: this.question.id, answers: answers, type: this.type});

    }
});