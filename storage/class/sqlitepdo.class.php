<?php
# Sqlite 3 PDO Database Class
# Created by Gideon Graphics Studio
# Date: October 12, 2008
/* 
Description: SQLITE 3 Class designed to intereact with database and output 	results for html, flash and xml.
* Uses Nine Methods:
* Database Interaction Methods
* (1) $object->query() - executes a database query
* (2) $object->fetchobject() - return query result as object
* (3) $object->fetcharray() - returns query results as an array
* (4) $object->fetchnum() - returns query results as column number reference
* (5) $object->checkrowCount() - checks total number of rows in a table
* (6) $object->connect()

* Special Formatting Methods
* (6) $object->showDataAsTable() - outputs results as html tables
* (7) $object->showDataAsURLEncoded() - outputs results as url data
* (8) $object->showDataAsXML() - outputs results as xml
* (9) $object->writeDataToXMLFile() - sends xml data to a filename of your choice.
*/

class sqlitePDO {

	#instantiate variables;
	
	private $dbase;
	private $result;
	private $link;
	private $row;
	public  $ext;
	private $qry;
	
	function __construct($dbase,$ext) {
		$this->dbase = $dbase;
		//$this->link	 = $link;
		$this->ext   = $ext;		
	}
	
	function connect() {
			$this->link = new PDO("sqlite:".$this->dbase.".".$this->ext);
	}
	
	#Query sqlite database results.
	function query($qry) {				
		$this->result = $this->link->prepare($qry);
		return $this->result->execute();
	}
	
	#Show result set as an object
	function fetchobject() {
		$row = $this->result->fetch(PDO::FETCH_OBJ);
		return $row;
	}
	
	#Show result set as an array
	function fetcharray() {
		$row = $this->result->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	#Show result set as a number
	function fetchnum() {
		$row = $this->result->fetch(PDO::FETCH_NUM);
		return $row;
	}
	
	#check total number of rows in database
	function checkrowCount() {
		$count = count($this->result->fetchAll());
		return $count;
	}
	
	
	#special formatting functions	
	#---------------------------------------------------------------------
	
	#Show data in html tabulated fashion 
	#takes three parameters (1) Table Header name ($tharr)
	#						(2) Table Cell values ($tdarr);
	#						(3) Table CSS class ($class) - optional
	
	function showDataAsTable($tharr, $tdarr, $class = '') {		
		#determine if a table class exists
		if($class == '') {
			echo "<table>";
		}
		else {
			echo '<table class="'.$class.'">';
		}
		
		#list table header values;
		echo '<tr>';
		for ($i=0; $i < count($tharr); $i++) {
			echo "<th>".$tharr[$i]."</th>";
		}
		echo'</tr>';
		
		#list table cell values;
		while($row = $this->fetchobject()) {
			echo "<tr>";
			for ($i=0; $i < count($tdarr); $i++) {
				echo "<td>".$row->$tdarr[$i]."</td>";				
			}
			echo "</tr>";
		}		
		echo "</table>";
	}
	#---------------------------------------------------------------------
	
	#Show data in a url encoded fashion (flash datafeed)
	#takes three parameters (1) name of variable to store values ($varname)
	#						(2> database row title ($titlearr)
	#						(3) database row value ($titleval)
	function showDataAsURLEncoded($varname, $rowtitle, $rowval) {	
		echo "{$varname}=";
		while($row = $this->fetchobject()) {
			for($i=0; $i < count($rowtitle); $i++) {
				echo urlencode("&{$rowtitle[$i]}=".$row->$rowval[$i]); 
			}
			
		}		
	}
	
	#---------------------------------------------------------------------
	
	#Creates xml formatted data
	#takes four parameters (1) opening and closing outer xml tags to wrap data ($tag)
	#						(2) inner xml tags to wrap data
	#						(3) database row title ($titlearr)
	#						(4) database row value ($titleval)
	function showDataAsXML($otag, $itag, $rowtitle, $rowval) {	
		$str = "<".$otag."> \n";
		while($row = $this->fetchobject()) {
			$str .= " \t<".$itag."> \n";
			
			for($i=0; $i < count($rowval); $i++) {
				$str.= "\t \t<".$rowtitle[$i].">".$row->$rowval[$i]."</".$rowtitle[$i]."> \n";
			}
			$str.="\t</".$itag.">\n";
		}
		$str .= "</".$otag.">";
		$xml = simplexml_load_string($str);
		echo $xml->asXML();
	}
	
	#---------------------------------------------------------------------
	# Sends xml formatted database information to a file
	# takes two parameters file path and filename
	
	function writeDataToXMLFile($otag, $itag, $rowtitle, $rowval) {
		$str = "<".$otag."> \n";
		while($row = $this->fetchobject()) {
			$str .= " \t<".$itag."> \n";
			
			for($i=0; $i < count($rowval); $i++) {
				$str.= "\t \t<".$rowtitle[$i].">".$row->$rowval[$i]."</".$rowtitle[$i]."> \n";
			}
			$str.="\t</".$itag.">\n";
		}
		$str .= "</".$otag.">";
		$xml = simplexml_load_string($str);
		
		$data = $xml->asXML();
		$fh = fopen("{$otag}.xml", "at");
		fwrite($fh, $data);
		fclose($fh);
	}
}


?>