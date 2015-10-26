Question.Views.QuestionsAdmin = Backbone.View.extend({

    events: {
        'click #go_back_btn' : 'onGoBack',
        'click #edit-btn' : 'openEditQuestionView',
        'click #btn_add_new_question' : 'openQuestionAddView'
    },
    initialize: function() {
        this.template = _.template($('#tpl-questions-old').html());
        this.router = Question.mainRouter;
    },

    render: function(collection) {
        var html = this.template({questions:collection});
        this.$el.html(html);
        return this;
    },

    openEditQuestionView: function(e) {
        var id = e.currentTarget.value;

        this.router.navigate("adminQuestion/edit/"+id, {trigger : true});
        //window.Question.eventManager.trigger('question:edit', {id:1});
    },

    openQuestionAddView: function() {
        this.router.navigate("adminQuestion/add", {trigger : true});
    },

    onGoBack: function(){
        this.router.goBack();
    }
});