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

        var question = new Question.Collections.Question();
        question.fetch({
            reset: true,
            success: function(collection, response, options) {
                var viewType = response.type;

                switch(viewType) {
                    case 'input':
                        viewClass = new Question.Views.Question();
                        break;
                    case 'radio':
                        viewClass = new Question.Views.QuestionRadio();
                        break;
                    case 'checkbox':
                        viewClass = new Question.Views.QuestionCheckbox();
                        break;
                    default:
                        viewClass = new Question.Views.Question();
                }

                $('#question').html(viewClass.render().$el);

                return me;
            }
        });
    }

});