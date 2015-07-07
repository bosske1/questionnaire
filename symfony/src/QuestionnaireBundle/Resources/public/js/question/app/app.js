window.Question = {
    Models: {},
    Collections: {},
    Views: {},

    start: function(data) {
        var question = new Question.Models.Question();


        Backbone.history.start();
    }
};

