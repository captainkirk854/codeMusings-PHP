<?php

# Use require to connect ..
require ('000-nonpublic-area/connect_db.php');

if (mysqli_ping($dbConnection))
{
    echo "MYSQL Server " . mysqli_get_server_info($dbConnection) . " on " . mysqli_get_host_info($dbConnection);    
}

?>