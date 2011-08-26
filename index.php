<?php
	define('ALLOW_ADMIN_IP', '127.0.0.1');

	if ($_SERVER['REMOTE_ADDR'] === ALLOW_ADMIN_IP)
		$show_options = TRUE;
	else
		$show_options = FALSE;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<title>Docman v0.5 | SystemsAcumen</title>
		<link rel="icon" type="image/png" href="assets/img/favicon.png"/>
		<!-- Basic Styling -->
		<link rel="stylesheet" href="assets/css/style.css"/>
		<!-- Dependencies -->
		<script type="text/javascript" src="lib/vendor/jquery/jquery.js"></script>
		<script type="text/javascript" src="lib/vendor/jquery/plugins/hotkeys.js"></script>
		<script type="text/javascript" src="lib/vendor/jquery/plugins/scroll-startstop.events.js"></script>
		<script type="text/javascript" src="lib/vendor/underscore/underscore.js"></script>
		<script type="text/javascript" src="lib/vendor/underscore/plugins/string.js"></script>
		<script type="text/javascript" src="lib/vendor/backbone/backbone.js"></script>
		<script type="text/javascript" src="lib/vendor/json2.js"></script>
		<script type="text/javascript" src="lib/vendor/namespace.js"></script>
		<script type="text/javascript" src="lib/vendor/proper.js"></script>
	</head>
	<body>
		<div id="header">
			<p>
				Application Docs v2.0.0
			</p>
			<div id="subheader">
				<div class="float-left">
					<h1 class="logo">Users Manual</h1>
				</div>
				<div class="float-right">
					<div id="spin-container"></div>
					<input name="s" type="text" id="search-field" class="float-left">
					<button class="button tangerine" id="search-button">
						Search
					</button>
				</div>
				<div class="float-reset"></div>
			</div>
		</div>
		<div id="sidebar"></div>
		<?php if ($show_options === TRUE):
		?>
		<ul id="docman-options"></ul>
		<?php endif;?>

		<div id="scrollable">
			<div id="content" class="smooth <?=($show_options === TRUE) ? "admin-enabled" : "";?>"></div>
		</div>
	</body>
	<!-- Docman -->
	<script type="text/javascript" src="lib/docman/Docman.js"></script>
	<script type="text/javascript" src="lib/docman/router/App.js"></script>
	<script type="text/javascript" src="lib/docman/router/Doc.js"></script>
	<script type="text/javascript" src="lib/docman/router/Search.js"></script>
	<script type="text/javascript" src="lib/docman/model/Docs.js"></script>
	<script type="text/javascript" src="lib/docman/model/Menus.js"></script>
	<script type="text/javascript" src="lib/docman/view/SearchForm.js"></script>
	<script type="text/javascript" src="lib/docman/view/Sidebar.js"></script>
	<script type="text/javascript" src="lib/docman/view/Content.js"></script>
	<!-- Docman Admin -->
	<?php if ($show_options === TRUE):
	?>
	<script type="text/javascript" src="lib/docman/admin/Router.js"></script>
	<script type="text/javascript" src="lib/docman/admin/View.js"></script>
	<script type="text/javascript" src="lib/docman/admin/ViewAdd.js"></script>
	<script type="text/javascript" src="lib/docman/admin/ViewModifyDoc.js"></script>
	<script type="text/javascript" src="lib/docman/admin/ViewSettings.js"></script>
	<?php endif;?>
	<script type="text/javascript">
		Docman.start();

	</script>
</html>