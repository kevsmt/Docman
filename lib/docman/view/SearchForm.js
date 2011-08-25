ns('Docman.View.SearchForm');

Docman.View.SearchForm.Button = new (Backbone.View.extend({

	el: '#search-button',

	events: {
		'click': 'doSearch'
	},

	doSearch: function ()
	{
		var keyword = $(Docman.View.SearchForm.TextField.el).val();

		if (!_.isBlank(keyword))
		{
			Docman.Router.App.navigate('/search/' + escape(keyword), true);
		}
	}

}));

Docman.View.SearchForm.TextField = new (Backbone.View.extend({

	el: '#search-field',

	events: {
		'keydown': 'doSearch'
	},

	doSearch: function (e)
	{
		if (e.keyCode == 13)
		{
			$(Docman.View.SearchForm.Button.el).click();
		}
	}

}));