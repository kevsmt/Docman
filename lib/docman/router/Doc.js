ns('Docman.Router.Doc');

Docman.Router.Doc = new (Backbone.Router.extend({

	routes: {
		'/doc/:id': 'get'
	},

	get: function (id)
	{
		Docman.View.Content.openDoc(id);
	},

	createLink: function (id)
	{
		return '#/doc/' + id;
	}

}));