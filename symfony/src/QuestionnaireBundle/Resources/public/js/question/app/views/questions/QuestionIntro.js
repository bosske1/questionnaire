Question.Views.QuestionIntro = Question.Views.Question.extend({

    type: 'intro',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-intro').html());
    },

    isValid: function(){
        return true;
    }
});