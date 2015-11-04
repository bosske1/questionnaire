/**
 * Admin index page
 */
Question.Views.Dashboard = Backbone.View.extend({
    events: {
        'click #btn_go_to_questionnaires' : 'onOpenAdminQuestionnairesView'
    },

    dashboardBodyId: '#dashboard-body',

    initialize: function() {
        this.template = _.template($('#tpl-dashboard').html());
        this.router = Question.mainRouter;
    },

    render: function(collection) {
        var me = this;
        var html = this.template();
        this.$el.html(html);

        Question.getService('DashboardViewsBuilder').setDashboardView(me).render();
        return this;
    },

    onOpenAdminQuestionnairesView: function(){
        this.router.navigate("adminQuestionnaires", {trigger : true});
    },

    getDashboardBody: function(){
        return this.$(this.dashboardBodyId);
    }
});
