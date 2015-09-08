<?php

# CONNECT TO MySQL DATABASE.

	# Use require to connect ..
	require ('000-nonpublic-area/connect_db.php');

	# Create a MySQL query.
	$query = 'SHOW TABLES' ;

	# Execute the query.
	$resultSet = mysqli_query( $dbConnection , $query ) ;

	# Show results.
	$tableCount = 0;
	if( $resultSet ) 
	{
	  echo '<h1>Tables in ' . DBNAME . ' database</h1> ' ;
	  
	  # Loop through resultset array ...
	  # MY_SQL_NUM = numeric array
      # MY_SQL_ASSOC = associative array (ie using column names)
      # MY_SQL_BOTH = numeric or associative
      while ( $row = mysqli_fetch_array( $resultSet, MYSQLI_NUM ) ) 
      {
        $tableCount += 1;
        echo '<br>'. $row[0] ;
      }
      
      if ($tableCount == 0)
      {
        echo '<p> <i> Oh - no tables here :( </i> </p>';
      }
      
      # Free result set resource ..
      mysqli_free_result( $resultSet ) ;
    }
    else
    {
      echo '<p>' . mysqli_error( $dbConnection ) . '</p>'  ;
    }

    # Close the connection.
    mysqli_close( $dbConnection ) ;
    
?>