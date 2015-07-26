Question.Views.QuestionsAdmin = Backbone.View.extend({

    /*events: {
        //'click #nextQuestionBtn' : 'getQuestion'
    },*/
    initialize: function() {
        this.template = _.template($('#tpl-questions').html());
    },

    render: function(collection) {
        var html = this.template({questions:collection});
        this.$el.html(html);
        return this;
    }
});