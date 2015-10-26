Question.Router = Backbone.Router.extend({
    routes: {
        'home': 'adminPage',
        'login': 'login',
        'admin': 'adminPage',

        'adminQuestionnaires': 'openAdminQuestionnairesView',
        'adminQuestionnaire/add' : 'openAddQuestionnaireView',
        'adminQuestionnaire/edit/:id' : 'openEditQuestionnaireView',

        'adminQuestion': 'openAddQuestionView',
        'adminQuestions/:id' : 'openAdminQuestionsView', //id == questionnaire id
        'adminQuestion/edit/:id': 'openEditQuestionView'
    },
    initialize: function() {
    },

    goBack: function(){
        window.history.back();
    },

    /**
     * admin index page
     */
    adminPage: function() {
        debugger;
        var me = this;

        var adminView = new Question.Views.Dashboard();
        $('#wrapper').html(adminView.render().$el);
    },

    openAdminQuestionsView: function(questionnaireId){
        var questions = new Question.Collections.Question();

        questions.fetch({
            reset: true,
            url: questions.getQuestionsUrl(questionnaireId),
            success: function(collection, response, options) {
                var questionsView = new Question.Views.QuestionsAdmin();
                $('#question').html(questionsView.render(collection).$el);
            }
        });
    },

    openEditQuestionView: function(id) {
        var editView = new Question.Views.EditView(),
            question = new Question.Models.Question({id: id});

        question.fetch({
            reset:true,
            success: function(model, response, options){
                $('#question').html(editView.render({question: model}).$el);
            },
            failure: function(){
                $('#question').html('well sh**').$el;
            }
        });
    },

    openAddQuestionView: function() {
        var editView = new Question.Views.AddView();
        $('#question').html(editView.render().$el);
    },

    openAdminQuestionnairesView: function() {
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

    openAddQuestionnaireView: function(){
        var editView = new Question.Views.AddQuestionnaireView();
        $('#question').html(editView.render().$el);
    },

    openEditQuestionnaireView: function(id){
        console.log('edit');
    }
});