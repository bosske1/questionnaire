Question.Models.Question = Backbone.Model.extend({
    defaults: {
        id: null,
        type: null,
        title: null,
        description: null,
        content: null,
        nextQuestionId: null,
        potentialAnswers: null,
        attachments: null
    },
    urlRoot: '/question/get',

    initialize: function() {
        this.potentialAnswers = new Question.Collections.PotentialAnswer();
        this.attachments = new Question.Collections.Attachment;
    }
/*
    parse: function(response) {

        // Check if response includes some nested collection data... our case 'nodes'
        if (_.has(response, 'potentialAnswers')){

            // Check if this model has a property called nodes
            if (!_.has(this, 'potentialAnswers')) {  // It does not...
                // So instantiate a collection and pass in raw data
                this.potentialAnswers = new Question.Collections.PotentialAnswer(response.potentialAnswers);
            } else {
                // It does, so just reset the collection
                this.potentialAnswers.reset(response.potentialAnswers);
            }

            // Assuming the fetch gets this model id
            this.potentialAnswers.url = 'question/getPotentialAnswers' + response.id;

            // Delete the nodes so it doesn't clutter our model attributes
            delete response.potentialAnswers;
        }

        // Check if response includes some nested collection data... our case 'nodes'
        if (_.has(response, 'attachments')){

            // Check if this model has a property called nodes
            if (!_.has(this, 'attachments')) {  // It does not...
                // So instantiate a collection and pass in raw data
                this.attachments = new Question.Collections.Attachment(response.attachments);
            } else {
                // It does, so just reset the collection
                this.attachments.reset(response.attachments);
            }

            // Assuming the fetch gets this model id
            this.attachments.url = 'question/getAttachments' + response.id;

            // Delete the nodes so it doesn't clutter our model attributes
            delete response.attachments;
        }

        return response;
    }/*,

    set: function(attributes, options) {
        debugger;
        // If we pass in answers collection JSON array and this model has a answers attribute
        // Assume we already set it as a collection
        if (_.has(attributes, 'potentialAnswers') && this.get("potentialAnswers")) {
            this.get('potentialAnswers').reset(attributes.potentialAnswers);
            delete attributes.potentialAnswers;
        } else if (_.has(attributes, 'potentialAnswers') && !this.get('potentialAnswers')) {
            this.set('potentialAnswers', new Question.Collections.PotentialAnswer(attributes.potentialAnswers));
            delete attributes.potentialAnswers;
        }

        if (_.has(attributes, 'attachments') && this.get("attachments")) {
            this.get('attachments').reset(attributes.attachments);
            delete attributes.attachments;
        } else if (_.has(attributes, 'attachments') && !this.get('attachments')) {
            this.set('attachments', new Question.Collections.Attachment(attributes.attachments));
            delete attributes.attachments;
        }

        return Backbone.Model.prototype.set.call(this, attributes, options);
    }*/
});