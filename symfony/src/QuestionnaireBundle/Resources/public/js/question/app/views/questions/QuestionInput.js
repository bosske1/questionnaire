Question.Views.QuestionInput = Question.Views.Question.extend({

    type: 'input',

    initialize: function() {
        this.template= _.template($('#tpl-question-input').html());
    },

    isValid: function(){
        var answer = this.$("input[name='answer']"),
            isInputValid = true;

        if(answer.value == ''){
            this.setErrorMessage('Please answer the question');
            isInputValid = false;
        }

        return isInputValid;
    },

    getValue: function() {
        return this.$('#answer').val();
    }
});