window.Question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var question = new Question.Models.Question(),
            router = new Question.Router();



        router.on('route:home', function() {
            var homeView = new Question.Views.Home();

            $('#question').html(homeView.render().$el);
        });

        router.on('route:question', function() {
            var view = new Question.Views.Question();

            $('#question').html(view.render().$el);
        });

        Backbone.history.start();
    }
};

