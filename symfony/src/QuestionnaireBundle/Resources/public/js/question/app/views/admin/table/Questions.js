Question.Views.Questions = Backbone.View.extend({
    events: {
        'click #btn_add_new_question' : 'openQuestionAddView'
    },

    renderOne: function(question) {
        var itemView = new Question.Views.QuestionRow({model: question});
        this.$('#questions-table').append(itemView.render().$el);
    },

    initialize: function() {
        this.template = _.template($('#tpl-questions').html());
        this.router = Question.mainRouter;
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        this.collection.each(this.renderOne, this);

        return this;
    },

    openQuestionAddView: function() {
        this.router.navigate("adminQuestion/add", {trigger : true});
    }
});