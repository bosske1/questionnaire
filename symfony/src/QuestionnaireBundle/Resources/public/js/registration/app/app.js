window.Registration = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var registration = new Registration.Models.Registration(),
            router = new Registration.Router();



        router.on('route:registration', function() {
            var view = new Registration.Views.Registration();

            $('#registration').html(view.render().$el);
        });

        Backbone.history.start();
    }
};

