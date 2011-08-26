ns('Docman.View.Content');

Docman.View.Content = new (Backbone.View.extend({

	el: '#content',

	initialize: function ()
	{
		$('#scrollable').bind('scrollstart', this.onScroll.bind(this));
		$('#scrollable').bind('scrollstop', this.onScrollStop.bind(this));
	},

	onScroll: function ()
	{
	//$(this.el).removeClass('smooth');
	},

	onScrollStop: function ()
	{
	//$(this.el).addClass('smooth');
	},

	setContent: function (html)
	{
		var self = this;
		$(this.el).removeClass('editing');
		$('#doc-control-container').remove();
		$('#proper-container').remove();
		$(this.el).html(html);
	},

	openDoc: function (id)
	{
		var doc = Docman.Model.Docs.getDoc(id);

		if (doc)
		{
			this.setContent(doc.get('body'));
		}
		else
		{
			this.setContent('Not Found!');
		}
	}

}));