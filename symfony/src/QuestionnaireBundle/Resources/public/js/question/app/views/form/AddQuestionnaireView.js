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

        this.postRender();
        return this;
    },

    onAdd: function(){
        var questionnaire = new Question.Models.Questionnaire();

        questionnaireData = $('#questionnaire_add').serializeObject();

        $.post('/questionnaire/create', questionnaireData);

        //prevent button default behaviour
        return false;
    },

    postRender: function(){
        this.populateCategories();
    },

    /**
     * populates $('#category') select
     *
     * @param value to be selected
     */
    populateCategories: function(value){
        var me = this;
        Question.getService('OptionsBuilder').getSingleSelectOptionsString('QuestionnaireCategory',{
            //value: 'bla',
            success: function(optionsString){
                me.$('#category').append(optionsString);
            }
        });
    }
});