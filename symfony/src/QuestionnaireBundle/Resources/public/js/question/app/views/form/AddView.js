Question.Views.AddView = Backbone.View.extend({

    events: {
        'click .btn-add' : 'onAdd'
    },

    initialize: function() {
        this.template = _.template($('#tpl-add-question').html());
        this.router = Question.mainRouter;
    },

    render: function(question) {
        var html = this.template();
        this.$el.html(html);
        return this;
    },

    onAdd: function(){
        var question = new Question.Models.Question();

        questionData = $('#question_add').serializeObject();

        $.post('/question/create', questionData);

        //prevent button default behaviour
        return false;
    }
});