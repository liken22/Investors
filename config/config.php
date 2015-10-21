<?php

//Attempt to open a connection to MySQL.
$mysqlhost = "74.50.0.138";
$mysqluser = "mywbcs3_vouser";
$mysqlpass = "j123ohn";
//Connection with Database.
$dbhandle = mysql_connect($mysqlhost, $mysqluser, $mysqlpass)
   or die("Unable to connect to MySQL " . mysql_error());
//Selecting the Database
$selected = mysql_select_db("mywbcs3_vo",$dbhandle) 
  or die("Could not select Database");
?>