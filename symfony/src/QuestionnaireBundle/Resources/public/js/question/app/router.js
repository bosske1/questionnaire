Question.Router = Backbone.Router.extend({
    routes: {
        'home': 'home'
    },
    initialize: function() {
        console.log('router initialized');
    }

});