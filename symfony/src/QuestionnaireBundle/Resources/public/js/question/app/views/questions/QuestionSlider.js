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

        var slider = new Slider("#ex1", {
            ticks: ticks,
            ticks_labels: tickLabels,
            ticks_snap_bounds: 15
        });
    }
});