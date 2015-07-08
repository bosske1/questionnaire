window.login = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    js: [
        'app/app.js',
        'app/router.js',
        'app/models/Login.js',
        'app/views/Login.js'
    ],
    init: function() {

        Login.start();
    }
};

$(document).ready(function(){
    login.init();
});