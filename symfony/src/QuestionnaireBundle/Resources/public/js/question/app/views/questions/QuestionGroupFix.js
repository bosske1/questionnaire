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
    }
});