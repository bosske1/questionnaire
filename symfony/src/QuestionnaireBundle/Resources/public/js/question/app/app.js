window.Question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var router = new Question.Router();
        this.mainRouter = router;

        Backbone.history.start();
    }
};

