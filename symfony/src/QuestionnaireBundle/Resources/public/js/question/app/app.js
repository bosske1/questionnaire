window.Question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var router = new Question.Router();


        Backbone.history.start();
    }
};

