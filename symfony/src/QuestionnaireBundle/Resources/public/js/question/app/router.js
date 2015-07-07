Question.Routers = Backbone.Router.extend({
    routes: {
        '': 'index'
    },
    initialize: function() {
        alert('router initialized');
    }

});