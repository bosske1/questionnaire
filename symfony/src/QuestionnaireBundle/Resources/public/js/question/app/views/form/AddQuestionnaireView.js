Question.Views.AddQuestionnaireView = Backbone.View.extend({

    events: {
        'click .btn-add' : 'onAdd'
    },

    initialize: function() {
        this.template = _.template($('#tpl-add-questionnaire').html());
        this.router = Question.mainRouter;
    },

    render: function(question) {
        var html = this.template();
        this.$el.html(html);
        return this;
    },

    onAdd: function(){
        var questionnaire = new Question.Models.Questionnaire();

        questionnaireData = $('#questionnaire_add').serializeObject();

        $.post('/questionnaire/create', questionnaireData);

        //prevent button default behaviour
        return false;
    }
});