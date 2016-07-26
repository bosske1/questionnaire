Question.Views.QuestionFinished = Question.Views.Question.extend({

    type: 'finished',
    errorMessage: null,

    initialize: function() {
        window.location = 'http://perscreen-basic.de/index.php';
    }
});