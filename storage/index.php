<?php

	define('DS', DIRECTORY_SEPARATOR);

	#check if pdo is installed
	if ( ! function_exists("sqlite_open") || ! (class_exists("PDO") && in_array("sqlite", PDO::getAvailableDrivers())))
	{
		die('SQL PDO Adapter is required.');
	}
	else
	{
		include ('class/class.db.php');
	}

	try
	{
		#get routing uri request
		$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : FALSE;
		@list($table, $id) = preg_split('/\//', substr($path_info, 1));

		//----------------------------------------------------------------------------
		// Prepare PDO
		//----------------------------------------------------------------------------

		$sql = null;
		$sqliterror = null;

		#db file location
		$dbfile = dirname(realpath(__FILE__)) . DS . 'db' . DS . 'docman.sqlite';

		#create new sqlite database object($dblink)
		$sqlite = new db('sqlite:' . $dbfile);

		#Error?
		if ($sqliterror !== null)
			die($sqliterror);

		//----------------------------------------------------------------------------
		#backbone emulateHTTP $_POST['_method']
		#create - POST /collection
		#read   - GET /collection[/id]
		#update - PUT /collection/id
		#delete - DELETE /collection/id

		$method = isset($_POST['_method']) ? $_POST['_method'] : 'GET';

		if ($method === 'GET')
		{
			$result = $sqlite -> select($table, ( ! empty($id) ? "ids = $id" : ''));
		}

		# deadly silent error :D will fixed soon, just to make things work right now
		if ( ! $result)
			$result = array();

		//sleep(rand(1,5));
		die(json_encode($result));
	}
	catch (PDOException $e)
	{
		print "Exception: " . $e -> getMessage();
	}
