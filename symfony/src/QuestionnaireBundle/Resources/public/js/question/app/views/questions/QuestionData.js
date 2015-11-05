Question.Views.QuestionData = Question.Views.Question.extend({

    type: 'data',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-data').html());
    },

    isValid: function(){
        return true;
    }
});