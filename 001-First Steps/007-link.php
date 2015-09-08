<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Link Data</title>
    </head>
    <body>

        <?php

            # Handle the submitted link data.
            if ( isset( $_GET['linkID'] ) ) 
            {
              $linkID = $_GET['linkID'] ;
              
              switch( $linkID )
              {
                case 1 : echo 'Cow selected<hr>' ; break ;
                case 2 : echo 'Dog selected<hr>' ; break ;
                case 3 : echo 'Goat selected<hr>' ; break ;
              }
            }

            # Display hyperlinks with appended linkID values.
            echo '<h1>Select a buddy</h1>' ;
            echo '<p>' ;
                echo ' <a href="007-link.php?linkID=1">Cow</a>    |' ;
                echo ' <a href="007-link.php?linkID=2">Dog</a>    |' ;
                echo ' <a href="007-link.php?linkID=3">Goat</a>    ' ;
            echo '</p>' ;

        ?>

    </body>
</html>