Question.Views.QuestionRow = Backbone.View.extend({
    model: null,
    tagName: 'tr',
    events: {
        'click #go_back_btn' : 'onGoBack',
        'click .show-questions-btn' : 'onOpenAdminQuestionsView',
        'click #edit-btn' : 'openEditQuestionView'
    },
    initialize: function() {
        this.template = _.template($('#tpl-question-row').html());
        this.router = Question.mainRouter;
    },

    render: function() {
        var html = this.template({'model' : this.model});
        this.$el.append(html);
        return this;
    },

    openEditQuestionView: function() {
        this.router.navigate("adminQuestion/edit/" + this.model.get('id'), {trigger : true});
    },

    onGoBack: function(){
        this.router.goBack();
    }
});