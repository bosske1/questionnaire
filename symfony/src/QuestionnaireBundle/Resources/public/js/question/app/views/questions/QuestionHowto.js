Question.Views.QuestionHowto = Question.Views.Question.extend({

    type: 'howto',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-howto').html());
    },

    isValid: function(){
        return true;
    }
});