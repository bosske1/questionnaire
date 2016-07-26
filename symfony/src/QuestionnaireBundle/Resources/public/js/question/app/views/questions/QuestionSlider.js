Question.Views.QuestionSlider = Question.Views.Question.extend({

    type: 'slider',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-slider').html());
    },

    postRender: function() {
        var ticks = new Array();
        var tickLabels = new Array();

        _.each(this.question.potentialAnswers, function(answer, key){
            ticks.push(answer.answer);
            tickLabels.push(answer.answer);
        });

        initSlider(parseInt(ticks[0]), parseInt(ticks[1]));

        this.initTimer();
        this.enableNext();
    },

    getValue: function() {
        var answer = this.$( ".slider" ).slider( "option", "value" );

        return answer;
    }
});