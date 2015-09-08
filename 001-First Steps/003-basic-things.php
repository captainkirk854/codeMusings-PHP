<?php

# ------------------------------
# Functions
# ------------------------------

# ------------------------------
function Welcome($person)
{
	date_default_timezone_set("UTC");
	$hour = date("H");
	$greeting = ($hour < 12) ? "<br> Good Morning " : "<br> Good Day ";
	$greeting .= $person;
	
	return $greeting .= "<br><br>"; 
}
# ------------------------------

# ------------------------------
function ListArray(
				   $inputArray,
	               $mode
                  )
{
    if (is_array($inputArray))
    {
        switch ($mode)
        {
            case 1: 
                    foreach ($inputArray as $index => $value )
                    {
                        echo "&bull; $value <br>";
                    };
                    break;
            case 2: 
                    foreach ($inputArray as $index => $value )
                    {
                        echo "&bull; $value ($index) <br>";
                    };
                    break;
            default: 
                    foreach ($inputArray as $index => $value )
                    {
                        echo "$value ($index) <br>";
                    };
                    break;
            
        }
    }
}
# ------------------------------

# ------------------------------
function CSV ($inputArray)
{
    if (is_array($inputArray))
    {
         asort($inputArray);
        return implode(",", $inputArray);
    }
    else
    {
        return NULL;
    }
}
# ------------------------------

# ------------------------------
function LoopMe ($inputArray)
{
    if (is_array($inputArray))
    {
        for ($i = 0; $i < count($inputArray); $i++)
        {
            echo "<dt> $inputArray[$i] <br>";
        }
    }
    else
    {
        return NULL;
    }
}
# ------------------------------

#Welcome ..
echo Welcome("Patrick");

# Examining arrays ...
$aFewMonthsPt1 = array("Jan","Feb", "Mar","Apr");
$aFewMonthsPt2 = array("my"=>"May","jn"=>"Jun", "jl"=>"Jul", "aug"=>"Aug"); # specifying a key name for each element
$aToz = range("a", "z");

# Looping through the array values directly
ListArray($aFewMonthsPt1, 1);
ListArray($aFewMonthsPt2, 1);
ListArray($aFewMonthsPt2, 2);
ListArray($aToz, 2);

# Loops ...
LoopMe($aToz);

# Create a csv ..
$csv = CSV($aToz);
echo "$csv <br>";

# Comparison with ternary operator ..
$result = ("PLOP" == "PLOP")? "PLOP_YES" : "PLOP_NO";
echo "PLOP==PLOP is $result <br>";

?>