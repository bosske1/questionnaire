window.Question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var question = new Question.Models.Question(),
            router = new Question.Router();

        router.on("route", function(route, params) {
            view = route.charAt(0).toUpperCase() + route.slice(1);

            var homeView = new Question.Views[view]();

            $('#question').html(homeView.render().$el);
        });

        Backbone.history.start();
    }
};

