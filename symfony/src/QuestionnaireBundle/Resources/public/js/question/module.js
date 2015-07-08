window.question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    js: [
        'app/app.js',
        'app/router.js',
        'app/models/Question.js',
        'app/views/Question.js'
    ],
    init: function() {

        Question.start();
    }
};

$(document).ready(function(){
    question.init();
});