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

    submitAnswer: function() {
        var answer = this.$('#answer_' + this.question.id).val();

        $.post('/question/submitAnswer', {questionId: this.question.id, answer: answer, type: this.type});
    }
});