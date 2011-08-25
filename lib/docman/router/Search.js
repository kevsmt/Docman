ns('Docman.Router.Search');

Docman.Router.Search = new (Backbone.Router.extend({

	routes: {
		'/search/:keyword': 'search'
	},

	search: function (keyword)
	{
		console.log('searching for: ' + keyword);
	}

}));