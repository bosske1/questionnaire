Question.Views.Questionnaires = Backbone.View.extend({
    events: {
        'click #btn_add_new_questionnaire': 'openAddView'
    },

    renderOne: function(questionnaire) {
        var itemView = new Question.Views.QuestionnaireRow({model: questionnaire});
        this.$('#questionnaires-table').append(itemView.render().$el);
    },

    initialize: function() {
        this.template = _.template($('#tpl-questionnaires').html());
        this.router = Question.mainRouter;
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        this.collection.each(this.renderOne, this);

        return this;
    },

    openAddView: function(){
        this.router.navigate("adminQuestionnaire/add", {trigger : true});
    }
});