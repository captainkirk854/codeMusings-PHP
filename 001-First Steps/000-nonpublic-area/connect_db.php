<?php

# Connection String Initialisation ...
$dbHost="localhost";
#$dbName="pafdb";
define ('DBNAME', 'sakila'); # Define DBNAME as a constant ..
$dbUser="paf";
$dbUserPass="paf";
$encoding="utf8";


# Attempt db connection
$dbConnection = mysqli_connect ($dbHost, $dbUser, $dbUserPass, DBNAME) or die (mysqli_connect_error()); 

# If successful, set encoding to match PHP script ..
mysqli_set_charset($dbConnection, $encoding)

?>