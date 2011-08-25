ns('Docman.Admin.ViewAddDoc');

(function(){

	var rawElId = 'new-doc-raw-content';
	var editor = new Proper();

	var toolset = [
	{
		html: 'H1',
		tip: 'Header 1',
		tag: 'h1'
	},{
		html: 'H2',
		tip: 'Header 2',
		tag: 'h2'
	},{
		html: 'H3',
		tip: 'Header 3',
		tag: 'h3'
	},{
		html: 'TEXT',
		tip: 'Paragraph',
		tag: 'p'
	},{
		html: 'CODE',
		tip: 'Code',
		tag: 'pre'
	},{
		html: 'BR',
		tip: 'Break/Empty Space',
		tag: 'br'
	},{
		html: 'HR',
		tip: 'Horizontal Rule',
		tag: 'hr'
	},
	/*[ 'H1', '_sectionInsertCmd', [{ tag:'h1' }] ],
    [ 'H2', '_sectionInsertCmd', [{ tag:'h2' }] ],
    [ 'H3', '_sectionInsertCmd', [{ tag:'h3' }] ],
    [ 'P', '_sectionInsertCmd', [{ tag:'p' }] ],
    [ 'STRONG', '_sectionInsertCmd', [{ tag:'strong' }] ],
    [ 'BREAK', '_sectionInsertCmd', [{ tag:'br' }] ],
    [ 'IMG', '_sectionInsertCmd', [{ tag:'img' }] ],
    [ 'CODE', '_sectionInsertCmd', [{ tag:'pre', multiline: false }] ],
    [ 'LINK', '_sectionInsertCmd', [{ tag:'a' }] ],
    [ 'PREVIEW', '_sectionInsertCmd', [{ tag:'_preview_' }]]*/
	];

	function insertHTMLTool (tool, section, html)
	{
		var body = $(section).find('.new-doc-body'),
		el = $('<' + tool.tag + '/>');

		// defaults
		tool = _.defaults(tool, {
			multiline: false,
			allowPaste: true
		});

		// change tool label
		$('.new-doc-tool', section).find('>li').first().text(tool.html);

		switch (tool.tag)
		{
			case 'h1':
			case 'h2':
			case 'h3':
				/*el.bind('paste', function (element, t) {
          return function (e)
          {
            setTimeout(function(){
              var content = $(element).html().trim()
                .replace(/\n/g, '')
                .replace(/\r/g, '')
                .replace(/<\S[^><]*>/g, '');

              $(element).text(content);
              $(element).focus();
            }, 1);
            return true;
          }
        }(el, tool));*/
				el.text(html||tool.tag).click(function() {
					editor.activate($(this), {
						markup: false,
						multiline: false
					});
				});

				break;
			case 'pre':
				el.text('').click(function() {
					editor.activate($(this), {
						markup: false,
						multiline: true
					});
				});
				break;
			case 'p':
				el.html('&laquo; Enter Text &raquo;').click(function() {
					editor.activate($(this), {
						markup: true,
						placeholder: 'Enter Text',
						controlsTarget: $('#proper-container')
					});
				});
		}

		body.append(el);
	};

	function createToolSet (section, view, removable)
	{
		var tool = $('<ul class="new-doc-tool"/>');

		tool.append($('<li>Insert Content</li>'))

		for (var item in toolset)
		{
			var li = $('<li/>'), handler = $('<a href="#"/>');

			handler.text(toolset[item].html);
			handler.attr('title', toolset[item].tip);

			handler.bind('click', function (t) {
				return function (e)
				{
					e.preventDefault();
					var new_section = view.createSection(section);
					insertHTMLTool(t, new_section);
				};
			}(toolset[item]));

			li.html(handler);
			tool.append(li);
		}

		if (removable === true)
		{
			var li = $('<li/>').append($('<a href="#"/>')
				.html('')
				.addClass('icon-delete-10')
				.css('opacity','0.4')
				.attr('title', 'Click to remove this section')
				.hover(function(){
					$(this).css('opacity', '0.7');
				},function(){
					$(this).css('opacity', '0.4');
				})
				.click(function(e) {
					e.preventDefault();
					editor.deactivate();
					$(section).remove();
				})
				);
			li.css('float', 'right');
			tool.append(li);
		}

		section.append(tool);
	};

	function createDocControls ()
	{
		var el = $('#doc-control-container'), previewToggle = false;

		var createItem = function (text, fn)
		{
			return $('<li/>').append(
				$('<a />')
				.attr('href', '#')
				.attr('title', text)
				.addClass(_.underscored(text))
				.click(fn)
				);
		};

		var save = createItem('Save', function (e) {
			e.preventDefault();
			alert("save");
		});

		var del = createItem('Delete', function (e) {
			e.preventDefault();
			alert("delete");
		});

		var print = createItem('Print', function (e) {
			e.preventDefault();
			alert("print");
		});

		var preview = createItem('Preview', function (e) {
			e.preventDefault();
			if (!previewToggle)
			{
				$('.new-doc-tool').hide();
				previewToggle = true;
			}
			else
			{
				$('.new-doc-tool').show();
				previewToggle = false;
			}
		});

		el.append(save, preview, print, del);
	};

	Docman.Admin.ViewModifyDoc = new (Backbone.View.extend({

		id: 'new-doc-sections',
		tagName: 'ul',

		render: function ()
		{
			var self = this,
			section = $(this.el);

			// Clear Contents
			section.empty();

			// Create Title Section
			var new_section = this.createSection(null);
			insertHTMLTool(toolset[0], new_section, 'Title');

			// Render this View
			Docman.View.Content.setContent('');

			$(Docman.View.Content.el)
			.html(this.el)
			.addClass('editing')
			.parent().append('<div id="proper-container"/>')
			.parent().append('<ul id="doc-control-container"/>');

			createDocControls();

			return this;
		},

		createSection: function (el)
		{
			var section = $('<li id="' + _.uniqueId('new-doc-section-') + '"/>');

			// Append section body
			section.append($('<div class="new-doc-body"/>'));

			// Append Tools
			createToolSet(section, this, (el && $(el) ? true : false));

			if (el && $(el))
			{
				$(section).insertAfter(el);
			}
			else
			{
				$(this.el).append(section);
			}

			return section;
		}

	}));

})();