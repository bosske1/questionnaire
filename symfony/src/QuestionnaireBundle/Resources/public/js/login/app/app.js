window.Login = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},

    start: function(data) {
        var login = new Login.Models.Login(),
            router = new Login.Router();



        router.on('route:login', function() {
            var view = new Login.Views.Login();

            $('#login').html(view.render().$el);
        });

        Backbone.history.start();
    }
};

