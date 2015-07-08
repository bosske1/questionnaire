Question.Router = Backbone.Router.extend({
    routes: {
        'home': 'home',
        'question': 'question',
        'registration': 'registration',
        'login': 'login'
    },
    initialize: function() {
        console.log('router initialized');
    }

});