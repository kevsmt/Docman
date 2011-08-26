<?php

	define('DS', DIRECTORY_SEPARATOR);

	#check if pdo is installed
	if ( ! function_exists("sqlite_open") || ! (class_exists("PDO") && in_array("sqlite", PDO::getAvailableDrivers())))
	{
		die('SQL PDO Adapter is required.');
	}
	else
	{
		include_once ("class/sqlitepdo.class.php");
	}

	try
	{
		#get routing uri request
		$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : FALSE;
		@list($table, $id) = preg_split('/\//', substr($path_info, 1));

		//----------------------------------------------------------------------------
		// Prepare PDO SQLite
		//----------------------------------------------------------------------------

		$sql = null;

		#db file location
		$dbfile = dirname(realpath(__FILE__)) . DS . 'db' . DS . 'docman';

		#create new sqlite database object($dblink)
		$dblink = new sqlitePDO($dbfile, "sqlite");

		#connect to sqlite3 database
		$dblink -> connect();

		//----------------------------------------------------------------------------
		#backbone emulateHTTP $_POST['_method']
		#create - POST /collection
		#read   - GET /collection[/id]
		#update - PUT /collection/id
		#delete - DELETE /collection/id

		$method = isset($_POST['_method']) ? $_POST['_method'] : 'GET';

		if ($method === 'GET')
		{
			$sql = "SELECT * FROM $table";
			if (isset($id) && $id)
				$sql .= " WHERE id = $id";
		}

		//----------------------------------------------------------------------------
		// Process Data
		//----------------------------------------------------------------------------

		if ($sql)
		{
			$result = $dblink -> query($sql);
			$data = array();

			if ($result > 0)
			{
				while ($row = $dblink -> fetcharray())
				{
					$data[] = $row;
				}
			}

			// sleep(rand(1,5));
			die(json_encode($data));
		}
	}
	catch (PDOException $e)
	{
		print "Exception: " . $e -> getMessage();
	}
