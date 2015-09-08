<?php

	function CheckEmail ($emailAddress)
	{
		$regexpPatternEmail = "/\b[\w.-]+@[\w.-]+\.[A-za-z]{2,6}\b/";
		
		if (!preg_match ($regexpPatternEmail, $emailAddress))
		{
			$emailAddress = "NOT EVEN A VALID EMAIL!!";
		}
		
		return $emailAddress;
	}


    # Receive variables from super global POST array which is treated as a hash table where the variables posted are treated as keys..
    $iPName = $_POST["inputName"];
    $iPMail = $_POST["inputMail"];
    $iPComments = $_POST["inputComments"];
    $iPHidden = $_POST["myHiddenVariableThatNoOneCanSee"];

    #Feedback HTML with various kinds of data validation ..
    if (strlen($iPName) < 2)
    {
        $iPName = "Mr. \"I can't be bothered to give a proper name\"" ;
    }
    echo "<p> Thanks for this winning comment $iPName ... </p>";
    
    if (! isset($iPComments) || empty(trim($iPComments)))
    {
        echo "<p><i> And you couldn't be bothered to write any comments </i></p>";
    }
    else
    {
        echo "<p><i> $iPComments </i></p>";
    }
    
    $iPMail = CheckEmail($iPMail);
    echo "<p> <b> We will bombard your email ($iPMail) with winning comments of our own </b> </p>";
    echo "<p> <i> And this was all done at $iPHidden </i> </p>";

?>