<!-- 
	This is just a regular html page which references another php via the action/post method
-->


<?php
	# There's a little bit of PHP here to set a time $variable ..
	date_default_timezone_set("UTC");
	$currentTime = date ("H:i-Fj");
?>

<html>
	<body>
		<form action = "004b-actions-handler.php" method = "POST">

			<dl>
				<dt> Name:
					<dd> <input type = "text" name = "inputName">

				<dt> Email Address:
					<dd> <input type = "text" name = "inputMail">

				<dt> Any Comments:
					<dd> <textarea rows="5" cols="50" name = "inputComments"> </textarea>
				
				<input type = "hidden" name = "myHiddenVariableThatNoOneCanSee" value = " <?php echo $currentTime ?> " <!-- How to pass a $variable -->
			</dl>

			<p> <input type = "submit"> </p>

		</form>
	</body>
</html>