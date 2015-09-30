Question.Views.QuestionsAdmin = Backbone.View.extend({

    events: {
        'click #edit-btn' : 'openEditView'
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
        this.router.navigate("editView", {trigger : true});
    }
});