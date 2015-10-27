Question.Views.QuestionnairesAdmin = Backbone.View.extend({
    events: {
        'click .show-questions-btn' : 'onOpenAdminQuestionsView',
        'click #edit-btn' : 'openEditView',
        'click #btn_add_new_questionnaire': 'openAddView'
    },
    initialize: function() {
        this.template = _.template($('#tpl-questionnaires-old').html());
        this.router = Question.mainRouter;
    },

    render: function(collection) {
        var html = this.template({questionnaires:collection});
        this.$el.html(html);
        return this;
    },

    openAddView: function(){
        this.router.navigate("adminQuestionnaire/add", {trigger : true});
    },

    openEditView: function(e) {
        var id = e.currentTarget.value;

        this.router.navigate("adminQuestionnaire/edit/"+id, {trigger : true});
    },

    onOpenAdminQuestionsView: function(e){
        var questionnaireId = e.currentTarget.value;

        this.router.navigate("adminQuestions/"+questionnaireId, {trigger: true})
    },

    renderDashboard: function(){
        var collection = new Question.Collections.Questionnaire(),
            viewTemplate = _.template($('#tpl-questionnaires-dashboard').html()),
            dashboardTemplate = _.template($('#tpl-dashboard-item').html());

        var itemHtml = viewTemplate({questionnaires:collection});

        this.$el.html(dashboardTemplate);
        this.$el.find('#dashboard-item-body').append(itemHtml);

        return this;
    }
});