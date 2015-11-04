Question.Views.QuestionnaireRow = Backbone.View.extend({
    model: null,
    tagName: 'tr',
    events: {
        'click .show-questions-btn' : 'onOpenAdminQuestionsView',
        'click #edit-btn' : 'openEditView'
    },
    initialize: function() {
        this.template = _.template($('#tpl-questionnaire-row').html());
        this.router = Question.mainRouter;
    },

    render: function() {
        var html = this.template({'model' : this.model});
        this.$el.append(html);
        return this;
    },

    openEditView: function() {
        this.router.navigate("adminQuestionnaire/edit/" + this.model.get('id'), {trigger : true});
    },

    onOpenAdminQuestionsView: function(){
        this.router.navigate("adminQuestions/" + this.model.get('id'), {trigger: true})
    }
});