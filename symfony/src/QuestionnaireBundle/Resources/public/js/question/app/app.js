window.Question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var question = new Question.Models.Question(),
            router = new Question.Router();

        router.on('route:home', function() {
            QuestionView = new Question.Views.Question();

            $('#question').html(QuestionView.render().$el);
        });

        Backbone.history.start();
    }
};

