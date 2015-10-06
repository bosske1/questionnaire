Question.Views.QuestionsAdmin = Backbone.View.extend({

    events: {
        'click #edit-btn' : 'openEditView',
        'click #btn_add_new_question' : 'openAddView',
        'click #btn_go_to_questionnaires' : 'openQuestionnaires'
    },
    initialize: function() {
        this.template = _.template($('#tpl-questions').html());
        this.router = Question.mainRouter;
    },

    render: function(collection) {
        var html = this.template({questions:collection});
        this.$el.html(html);
        return this;
    },

    openEditView: function() {
        //this.router.navigate("editView", {trigger : true});
        window.Question.eventManager.trigger('question:edit', {id:1});
    },

    openAddView: function() {
        this.router.navigate("addView", {trigger : true});
    },

    openQuestionnaires: function() {
        this.router.navigate("questionnaireAdmin", {trigger : true});
    }
});