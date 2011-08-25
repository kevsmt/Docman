ns('Docman.Admin.Router');

Docman.Admin.Router = new (Backbone.Router.extend({

	routes: {
		'/settings': 'settings',
		'/menu/new': 'add_menu',
		'/doc/new': 'add_document',
	},

	settings: function ()
	{
		Docman.Admin.ViewSettings.render();
	},

	add_menu: function ()
	{
		Docman.Admin.ViewAdd.render();
	},

	add_document: function ()
	{
		Docman.Admin.ViewModifyDoc.render();
	}

}));