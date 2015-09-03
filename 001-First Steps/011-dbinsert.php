<?php 
	# CONNECT TO MySQL DATABASE.

	# Use require to connect ..
	require ('000-nonpublic-area/connect_db.php');


	# --------------------------------------------------------------------------------------
	# Function to create and execute a MySQL query.
	# --------------------------------------------------------------------------------------
	function ShowRecords( $dbConnection, $rowStart, $rowEnd)
	{
	  $query = '
	  			select 
					ACTOR_ID, 
					FIRST_NAME, 
					LAST_NAME, 
					LAST_UPDATE 
				  from 
				  	ACTOR
			  order by 
			  		LAST_UPDATE desc,
					ACTOR_ID desc
			     limit ' . $rowStart . ',' . $rowEnd
					 ;
					 
	  $resultSet = mysqli_query( $dbConnection , $query ) ;
	  
	  if ( $resultSet )
	  {
	  	  $numColumns = 3;
	      echo '<h1>Records in ACTOR table</h1> ' ;
	      while ( $row = mysqli_fetch_array( $resultSet , MYSQLI_BOTH ) ) 
	      {
	       	echo '<br>' . $row['ACTOR_ID'] . ' | ' . $row[ 'FIRST_NAME' ] .  ' @ ' . $row[ 'LAST_NAME' ] ;
			for ($i = 0; $i < $numColumns ; $i++ )
			{
				$result = is_numeric($row[$i]) ? " NUMERIC " : " NOT NUMERIC " ;
				echo "<li><i>".$row[$i]." is ".$result."</i></li>";
			}
	      }
	  } 
	  else 
	  { 
	  	echo '<p>' . mysqli_error( $dbConnection ) . '</p>'  ; 
	  }
	}
	# --------------------------------------------------------------------------------------
	
	# Call the function.
	ShowRecords($dbConnection, 0, 5) ;
	  
	# Create and execute another MySQL query.
	$ddl = 'insert into ACTOR ( FIRST_NAME , LAST_NAME ) VALUES ( "William" , "Shatner" ) , ( "Leonard" , "Nimoy" ) , ( "Number" , "1" ), ( "Number" , 2 ), ( "Arnold" , "Schwarzenegger" )   ' ;
	$resultSet = mysqli_query( $dbConnection , $ddl ) ;

	# Call the function again.
	if( $resultSet) 
	{
		echo '<h1> <i> AFTER INSERT </i></h1> ' ; 
		ShowRecords($dbConnection, 0, 300) ; 
	} 
	else 
	{ 
		echo '<p>' . mysqli_error( $dbConnection ) . '</p>'  ; 
	}

	# Close the connection.
	mysqli_close( $dbConnection ) ;

?>