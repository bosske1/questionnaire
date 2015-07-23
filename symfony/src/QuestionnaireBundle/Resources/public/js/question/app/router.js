Question.Router = Backbone.Router.extend({
    routes: {
        'home': 'home',
        'question': 'question',
        'registration': 'registration',
        'login': 'login'
    },
    initialize: function() {
        console.log('router initialized');
    },

    question: function() {
        var me = this;

        var question = new Question.Models.Question({id: 2});
        question.fetch({
            success: function(model, response, options) {
                var questionResponse = response[0];
                var viewType = questionResponse.type;

                switch(viewType) {
                    case 'input':
                        console.log('we have input');
                        viewClass = new Question.Views.Question();
                        break;
                    case 'radio':
                        console.log('we have radio');
                        viewClass = new Question.Views.QuestionRadio();
                        break;
                    case 'checkbox':
                        console.log('we have checkbox');
                        viewClass = new Question.Views.QuestionCheckbox();
                        break;
                    default:
                        console.log('we have default');
                        viewClass = new Question.Views.Question();
                }

                $('#question').html(viewClass.render({question: questionResponse}).$el);

                return me;
            }
        });
    }

});