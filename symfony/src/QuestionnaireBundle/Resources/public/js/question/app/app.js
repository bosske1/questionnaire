window.Question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    controllers: ['QuestionsController'],

    start: function(data) {
        var router = new Question.Router();
        this.mainRouter = router;
        this.eventManager = _.extend( {}, Backbone.Events );

        Backbone.history.start();

        // Now let's initialize some stuff:
        _.each(this.controllers, function(controllerName) {
            var controller = new this[controllerName]();
            controller.bindEvents();
        });
    }
};

