Question.Views.QuestionCheckbox = Question.Views.Question.extend({

    type: 'checkbox',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-checkbox').html());
    },

    isValid: function(){
        var answers = this.$("input[name='answer']"),
            isSomethingChecked = false;

        for(var i = 0; i < answers.length; i++){
            answer = answers[i];

            if(answer.checked){
                isSomethingChecked = true;
            }
        }

        if(!isSomethingChecked){
            this.setErrorMessage('Please select at least one answer');
        }

        return isSomethingChecked;
    },

    postRender: function() {
        //var tickLength = this.getTickLength();
        //initTimer(tickLength);

        var me = this;

        $(".checkbox_answers").click(function() {me.enableNext();});

        this.initTimer();
    },

    getValue: function() {
        //
    }
});