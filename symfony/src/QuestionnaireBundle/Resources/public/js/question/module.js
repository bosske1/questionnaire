window.question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    js: [
        'app/app.js',
        'app/models/Question.js'
    ],
    init: function() {

        Question.start();
    }
};

$(document).ready(function(){
    question.init();
});