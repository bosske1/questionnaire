window.registration = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    js: [
        'app/app.js',
        'app/router.js',
        'app/models/Registration.js',
        'app/views/Registration.js'
    ],
    init: function() {

        Registration.start();
    }
};

$(document).ready(function(){
    registration.init();
});