/**
 * Admin index page
 */
Question.Views.Dashboard = Backbone.View.extend({
    events: {
        'click #btn_go_to_questionnaires' : 'onOpenAdminQuestionnairesView'
    },
    initialize: function() {
        this.template = _.template($('#tpl-dashboard').html());
        this.router = Question.mainRouter;
    },

    render: function(collection) {
        var html = this.template();
        this.$el.html(html);
        return this;
    },

    onOpenAdminQuestionnairesView: function(){
        this.router.navigate("adminQuestionnaires", {trigger : true});
    }
});