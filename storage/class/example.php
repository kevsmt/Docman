<?php
	include_once("sqlitepdo.class.php");
	
	#create new sqlite database object($dblink)
	$dblink = new sqlitePDO("step7", "sqlite3");	
	
	#connect to sqlite3 database
	$dblink->connect();
	
	#query sqlite3 database
	$qry = "SELECT * FROM currval ORDER BY currid ASC LIMIT 5";	
	$dblink->query($qry);	
	
	
	#data is fed via an array
	#this example shows array values used to format as xml, html, urlencoded data.
	
	#create a tableheader array
	$tharr = array(
					'ID', 
					'Currency', 
					'Value'
					);
	
	#create a tablecell array
	$tdarr = array(
					'currid',
					'currname', 
					'currval'
					);
	
	#EXAMPLE 1: Outputting data in html tablulated format 
	#specify a css class for table (optional)
	# $css = 'tablelist';	
	$dblink->showDataAsTable($tharr, $tdarr, $css);
	
	#--------------------------------------------------------------------------
	
	#EXAMPLE 2: Outputting data in urlencoded format( useful for flash fed data)
	#specify the name of the variable that will hold urlencoded data ($varname)
	#$varname = "data";
	#$dblink->showDataAsURLEncoded($varname, $tharr, $tdarr);
	
	#--------------------------------------------------------------------------
	
	#EXAMPLE 3: output data as xml
	#specify (a) the outer xml tag ($otag) and
	#(b) the inner xml tag($itag) that will encase the xml data - adhering to well-formedness rule.
	#eg:
	#<?xml version="1.0"?\>
	# <$otag>
	#	<$itag>
	#		<itemtitle>item</itemtitle>
	#		<itemtitle>item</itemtitle>
	#		<itemtitle>item</itemtitle>
	#	</$itag>
	# </$otag>
	
	#$otag = "currencydata";
	#$itag = "currency";
	#$dblink->showDataAsXML($otag, $itag, $tharr, $tdarr);
	#--------------------------------------------------------------------------
	
	#EXAMPLE 4: write data to xml file
	#$otag = "currencydata";
	#$itag = "currency";
	#$dblink->writeDataToXMLFile($otag, $itag, $tharr, $tdarr);
	

?>