Question.Views.QuestionSlider = Question.Views.Question.extend({

    type: 'slider',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-slider').html());
    },

    postRender: function() {
        var slider = new Slider('#ex1', {
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });
    }
});