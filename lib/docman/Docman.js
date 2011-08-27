(function(context) {
	
	// This is just a test project using backbone and everything
	// possible :D
	
	context.Docman = {
		storeURL: '/docman/storage'
	};
	
	head.js(
		'lib/vendor/namespace.js',
		'lib/vendor/jquery/jquery.js',
		'lib/vendor/jquery/plugins/hotkeys.js',
		'lib/vendor/underscore/underscore.js',
		'lib/vendor/underscore/plugins/string.js',
		'lib/vendor/backbone/backbone.js',
		'lib/vendor/proper.js',
		'lib/docman/router/App.js',
		'lib/docman/router/Doc.js',
		'lib/docman/router/Search.js',
		'lib/docman/view/SearchForm.js',
		'lib/docman/view/Sidebar.js',
		'lib/docman/view/Content.js',
		'lib/docman/model/Docs.js',
		'lib/docman/model/Menus.js',
		'lib/docman/admin/Router.js',
		'lib/docman/admin/View.js',
		'lib/docman/admin/ViewAdd.js',
		'lib/docman/admin/ViewModifyDoc.js',
		'lib/docman/admin/ViewSettings.js',
		function () {
			// Queue Ajax Counter
			var queue_cnt = 0;
			
			// Activate Spinner when AJAX is loading (global)
			$.ajaxSetup({
				beforeSend: function ()
				{
					queue_cnt++;
					setTimeout(function() {
						if (queue_cnt !== 0)
						{
							if (queue_cnt === 0) return;
							$('#spin-container').show();
						}
					}, 100);
				},
				complete: function ()
				{
					queue_cnt--;
					if (queue_cnt <= 0)
					{
						queue_cnt = 0;
						$('#spin-container').hide();
					}
				}
			});
			
			// Load Tree
			Docman.Model.Menus.fetch();
			
			// Load Docs
			Docman.Model.Docs.fetch({
				success: function ()
				{
					Backbone.history.start();
				}
			});
		}
	);
})(this);