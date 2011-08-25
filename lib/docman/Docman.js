ns('Docman');

Docman.start = function ()
{
	var queue;

	// Activate Spinner when using AJAX also if only greater than 100ms response time
	//
	$.ajaxSetup({
		beforeSend: function ()
		{
			queue++;
			setTimeout(function() {
				if (queue !== 0)
				{
					if (queue === 0 ) return;
				}
			}, 100);
		},

		complete: function ()
		{
			queue--;
			if (queue <= 0)
			{
				queue = 0;
			}
		}

	});

	// Load Our Tree
	//
	Docman.Model.Menus.fetch();

	// Load Our Tree
	//
	Docman.Model.Docs.fetch({
		success: function ()
		{
			Backbone.history.start({
				pushState: false
			});
		}
	});
};