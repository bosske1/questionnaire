/**
 * Admin index page
 */
Question.Views.Dashboard = Backbone.View.extend({
    events: {
        'click #btn_go_to_questionnaires' : 'onOpenAdminQuestionnairesView'
    },

    views: [],

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

Question.Views.SomeView1 = Backbone.View.extend({
    events: {
        'click #btn_go_to_questionnaires' : 'onOpenAdminQuestionnairesView'
    },

    initialize: function() {
        this.template = 'SomeView1';
        this.router = Question.mainRouter;
    },

    render: function() {
        var html = this.template;
        this.$el.html('SomeView1');

        return this;
    }
});

Question.Views.SomeView2 = Backbone.View.extend({
    events: {
        'click' : 'yo'
    },

    initialize: function() {
        this.template = 'SomeView2';
        this.router = Question.mainRouter;
    },

    render: function() {
        var html = this.template;
        this.$el.html('SomeView2');

        return this;
    },

    yo: function(){
        alert('yo');
    }
});