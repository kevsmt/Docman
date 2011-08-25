ns('Docman.Model.Menus');

Docman.Model.Menus = new (Backbone.Collection.extend({

	url: 'http://localhost:8887/4F/docman/storage/menus',

	model: Backbone.Model.extend({
		defaults: {
			"id": this.cid,
			"parent": "",
			"text": "",
			"route": ""
		}
	}),

	initialize: function ()
	{
		this.bind('reset', function () {
			Docman.View.Sidebar.renderMenuItems();
		});
	}

}));
