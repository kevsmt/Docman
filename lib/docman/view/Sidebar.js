ns('Docman.View.Sidebar');

Docman.View.Sidebar = new (Backbone.View.extend({

	el: '#sidebar',

	addHeader: function (text)
	{
		$(this.el).append('<h3>' + text + '</h3>');
	},

	createItemContainer: function (id)
	{
		$(this.el).append('<ul id="' + id + '"/>');
		return $(this.el).find(' ul#' + id).last();
	},

	addItem: function (container, link, text)
	{
		if (_.isString(container))
			container = $(container);

		container.append('<li/>');
		container.find('>li').last()
		.append('<a href="' + link + '">' + text + '</a>');
	},

	renderMenuItems: function ()
	{
		var self = this;
		$(this.el).empty();

		this.addHeader('API Reference');
		var c = this.createItemContainer('sidebar-item-box');

		Docman.Model.Menus.map(function (item) {
			self.addItem(c, Docman.Router.Doc.createLink(item.get('doc_id')), item.get('text'));
		});
	}

}));