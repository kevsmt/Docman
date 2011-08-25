ns('Docman.Router.App');

Docman.Router.App = new (Backbone.Router.extend({

	routes: {
		"/about": "about",
		"/help": "help",
		"/feedback": "feedback"
	},

	about: function (id)
	{
		console.log('About');
	},

	help: function (id)
	{
		console.log('Help');
	},

	feedback: function (id)
	{
		console.log('Feedback');
	}

}));