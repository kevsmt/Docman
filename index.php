<!DOCTYPE html>
<html>
	<head>
		<title>Docman v0.5 | SystemsAcumen</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">		
		<link rel="icon" type="image/png" href="assets/img/favicon.png"/>
		<!-- Basic Styling -->
		<link rel="stylesheet" href="assets/css/style.css"/>
		<!-- Scripts -->
		<script type="text/javascript" src="lib/vendor/head.js"></script>
		<script type="text/javascript" src="lib/docman/Docman.js"></script>
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
		<ul id="docman-options"></ul>

		<div id="scrollable">
			<div id="content" class="smooth admin-enabled"></div>
		</div>
	</body>
	
</html>