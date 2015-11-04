/**
 *
 * Get data from backend, set views, render them, show them :)
 */
Question.Services.DashboardViewsBuilder = {

    //views container
    views: [
        //just example here
        {
            view: 'QuestionnairesAdmin'
        }
    ],

    dashboardView: null,

    /**
     * render each view to dashboard body
     */
    render: function(){
        var me = this,
            views = this.getViews();

        $.each(views, function(index, view){
            me.getDashboardView().getDashboardBody().append(view.renderDashboard().$el);
            me.bindDashboardEvents(view);
        });
    },

    /**
     * collect view objects
     *
     * @returns {Array}
     */
    getViews: function(){
        var me = this,
            viewClasses = [];

        $.each(me.views, function(index, viewClassName){
            viewClass = me.buildViewClass(viewClassName.view);
            if(viewClass !== false){
                viewClasses.push(viewClass);
            }
        });

        return viewClasses;
    },

    /**
     * remove view
     *
     * @param viewClassName
     */
    remove: function(viewClassName){
        //remove view

        return this;
    },

    /**
     * add view
     *
     * @param viewClassName
     */
    add: function(viewClassName){
        //add view
    },

    /**
     *  try to create view, if it's not a function return false
     *
     * @param viewClass
     * @returns {boolean}
     */
    viewExists: function(viewClass){
        try {
            classView = new Question.Views[viewClass];

            return true;
        }
        catch(err) {
            return false;
        }
    },

    buildViewClass: function(className){
        var viewClass = null;

        if(typeof className != 'undefined' && className != '' && className != null){
            viewClass = this.capitalizeFirstLetter(className);
        }

        if(this.viewExists(viewClass)){
            return new Question.Views[viewClass]();
        }

        return false;
    },

    /**
     * well, shouldn't be here but better not touch prototype of the String
     *
     * @param string
     * @returns {string}
     */
    capitalizeFirstLetter: function(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
    },

    setDashboardView: function(view){
        this.dashboardView = view;

        return this;
    },

    getDashboardView: function(){
        return this.dashboardView;
    },

    bindDashboardEvents: function(view){
        var me = this;

        view.$el.find('.removeView').on('click', me.onRemoveView.bind(view))
        view.$el.find('.refreshView').on('click', me.onRefreshView.bind(view))
    },

    onRemoveView: function(){
        this.$el.remove();
        //remove from dashboard builder

        return false;
    },

    onRefreshView: function(){
        this.renderDashboard();
        return false;
    }
};