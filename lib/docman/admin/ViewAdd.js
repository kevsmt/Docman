ns('Docman.Admin.ViewAdd');

Docman.Admin.ViewAdd = new (Backbone.View.extend({

	render: function ()
	{
		$.get('lib/docman/admin/templates/add.tpl?' + (new Date()))
		.success(function (data) {
			Docman.View.Content.setContent(data);
		})
		.error(function (data) {
			Docman.View.Content.setContent('<h3>ERROR CODE: ' +
				data.status + '</h3><br/><p>Sorry there was an error loading that page.</p>');
		});
	}

}));