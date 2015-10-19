Question.Router = Backbone.Router.extend({
    routes: {
        'home': 'home',
        'question': 'question',
        'registration': 'registration',
        'login': 'login',
        'admin': 'adminPage',
        'editView': 'openEditView',
        'addView': 'openAddView',
        'questionnaireAdmin': 'openQuestionnaireAdminPage',
        'tree' : 'tree'
    },
    initialize: function() {
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

                viewClass = Question.getService('QuestionBuilder').get(viewType);

                viewClass.question = questionResponse;
                $('#question').html(viewClass.render({question: questionResponse}).$el);

                viewClass.postRender();

                return me;
            }
        });
    },

    adminPage: function() {
        var me = this;
        var questionnaireId = 1;

        var questions = new Question.Collections.Question();
        //questions.setQuestionnaireId(questionnaireId);
        questions.url += "/" + questionnaireId;
        questions.fetch({
            reset: true,
            success: function(collection, response, options) {
                var questionsView = new Question.Views.QuestionsAdmin();
                $('#question').html(questionsView.render(collection).$el);
            }
        });
    },
    openEditView: function() {
        var editView = new Question.Views.AddView();
        $('#question').html(editView.render().$el);
    },

    openAddView: function() {
        var editView = new Question.Views.AddView();
        $('#question').html(editView.render().$el);
    },

    openQuestionnaireAdminPage: function() {
        var me = this;
        var questionnaires = new Question.Collections.Questionnaire();

        questionnaires.fetch({
            reset: true,
            success: function(collection, response, options) {
                var questionnairesView = new Question.Views.QuestionnairesAdmin();
                $('#question').html(questionnairesView.render(collection).$el);
            }
        });
    },

    tree: function(){
        var me = this;
        var treeItems = new Question.Collections.Tree();

        treeItems.fetch({
            reset: true,
            success: function(collection, response, options) {
                var treeView = new Question.Views.Tree({
                    collection: collection
                });
                $('#question').html(treeView.render().$el);
            }
        });
    }

});