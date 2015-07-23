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

    question: function(questionId) {
        var me = this,
            questionId = questionId;

        if(questionId == null){
            questionId = 1; //yo yo :)
        }

        var question = new Question.Models.Question({id: questionId});
        question.fetch({
            success: function(model, response, options) {
                if(response.length == 0){
                    console.error('Could not find question with id of ' + questionId);
                    return;
                }

                var questionResponse = response[0];
                var viewType = questionResponse.type;

                switch(viewType) {
                    case 'input':
                        console.log('we have input');
                        viewClass = new Question.Views.QuestionInput();
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
                        viewClass = new Question.Views.QuestionInput();
                }

                viewClass.question = questionResponse;
                $('#question').html(viewClass.render({question: questionResponse}).$el);

                return me;
            }
        });
    }

});