
<?php 
# CONNECT TO MySQL DATABASE.

	# Use require to connect ..
	require ('000-nonpublic-area/connect_db.php');

	# Create a MySQL query.
	$query = 'SHOW TABLES' ;

	# Execute the query.
	$resultSet = mysqli_query( $dbConnection , $query ) ;

	# Show results.
	if( $resultSet ) 
	{
	  echo '<h1>Result Set Returned OK</h1>' ;
	}
    else
    {
      echo '<p>' . mysqli_error( $dbConnection ) . '</p>' ;
    }

    # Close the connection.
    mysqli_close( $dbConnection ) ;
?>