window.question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    js: [
        'app/app.js',
        'app/router.js',
        'app/models/Question.js',
        'app/views/Question.js',
        'app/views/Home.js',
        'app/views/Login.js',
        'app/views/Registration.js'
    ],
    init: function() {

        Question.start();
    }
};

$(document).ready(function(){
    question.init();
});