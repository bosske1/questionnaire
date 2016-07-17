Question.Views.QuestionRadio = Question.Views.Question.extend({

    type: 'radio',
    errorMessage: null,

    somethingSelected: false,

    initialize: function() {
        this.template= _.template($('#tpl-question-radio').html());
    },

    isValid: function(){
        return this.somethingSelected;
    },

    postRender: function() {
        var me = this;

        $(".radio_answers").click(function() {me.somethingSelected = true; me.enableNext();});

        //var tickLength = this.getTickLength();
        //initTimer(tickLength);
        this.initTimer();
    },

    getNextQuestionId: function() {
        // Can be overwritten if needed:
        return this.question.nextQuestionId;
    },

    getValue: function() {
        // let's find the selected radio button:
        return this.$("input:radio[name ='answer']:checked").val();
    }
});