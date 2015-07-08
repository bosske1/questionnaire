Question.Router = Backbone.Router.extend({
    routes: {
        'home': 'home',
        'question': 'question'
    },
    initialize: function() {
        console.log('router initialized');
    }

});