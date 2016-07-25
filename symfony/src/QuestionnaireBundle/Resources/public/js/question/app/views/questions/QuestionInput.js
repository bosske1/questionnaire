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

    postRender: function() {
        var me = this;

        if (me.question.potentialAnswers && me.question.potentialAnswers.length > 0) {
            var potentialAnswer = me.question.potentialAnswers[0];
            var prefillType = potentialAnswer.realAnswer;

            if (prefillType == 'today') {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();

                if(dd<10) {
                    dd='0'+dd
                }

                if(mm<10) {
                    mm='0'+mm
                }

                today = dd+'.'+mm+'.'+yyyy;

                this.$("#answer").val(today);

                me.enableNext();
            }
        }

        this.$("#answer").on('keyup', function(){
            if (this.value) {
                me.enableNext();
            }
        });

        me.initTimer();
    },

    getValue: function() {
        return this.$('#answer').val();
    }
});