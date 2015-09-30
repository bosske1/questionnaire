Question.Views.QuestionInput = Question.Views.Question.extend({

    type: 'input',

    initialize: function() {
        this.template= _.template($('#tpl-question-input').html());
    },

    isValid: function(){
        var answer = this.$("input[name='answer']")[0],
            isInputValid = true;

        if(answer.value == ''){
            this.setErrorMessage('Please answer the question');
            isInputValid = false;
        }

        return isInputValid;
    }
});