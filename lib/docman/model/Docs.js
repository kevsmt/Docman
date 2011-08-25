ns('Docman.Model.Docs');

Docman.Model.Docs = new (Backbone.Collection.extend({

	url: 'http://localhost/docman/storage/docs',

	model: Backbone.Model.extend({
		defaults: {
			"id": this.cid,
			"title": "",
			"body": ""
		}
	}),

	getDoc: function (id)
	{
		var doc = Docman.Model.Docs.get(id);
		if (_.isUndefined(doc)) return this._currentDoc = false;
		return this._currentDoc = doc;
	},

	currentDoc: function ()
	{
		return this._currentDoc || false;
	}

}));