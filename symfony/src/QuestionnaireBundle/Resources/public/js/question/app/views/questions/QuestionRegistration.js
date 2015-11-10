Question.Views.QuestionRegistration = Question.Views.Question.extend({

    type: 'registration',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-registration').html());
    },

    isValid: function(){
        return true;
    },

    postRender: function() {
        initRegistration();
    }
});