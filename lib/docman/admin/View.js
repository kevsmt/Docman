ns('Docman.Admin.View');

Docman.Admin.View = new (Backbone.Router.extend({

	el: '#docman-options',

	initialize: function ()
	{
		this.renderAdminOptions();

		// Configure Sidebar to allow options to be rendered
		//
		$(Docman.View.Sidebar.el).addClass('space-options');
		$('#docman-options').css('display', 'block');
	},

	renderAdminOptions: function ()
	{
		var con = $(this.el),
		routes = Docman.Admin.Router.routes,
		keys = Object.keys(Docman.Admin.Router.routes);

		_.map(keys, function (r) {
			con.append('<li><a title="' + _.capitalize(routes[r].replace(/_/g, ' ')) + '" href="#' + r +
				'" class="docman-options-icon ' + routes[r] + '"></a></li>');
		});
	}

}));