<?php
	print( "<html>\n
\n<head>
\n  <title>Select games from Database</title>
\n  <link href=\"php_mysql.css\" rel=\"stylesheet\" type=\"text/css\" />
\n  </head>\n
	<body>\n
	<div id = \"content\"><h1>Select Games by Genre:</h1><br />
	  <form action=\"report2Final.php\" method=\"post\">");

	include ('/home/jl4282/jl_config.php');

	/* Note: nl2br inserts HTML line breaks before all newlines in a string */
	$db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
	if ($db_link->connect_errno) {
		print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
	}
	/* print("<p>Connection: ".$db_link->host_info . "<br />\n"); */
	/* print( nl2br("Connected successfully\n"));                 */


	$query =
	"SELECT genreName 
	 FROM genre
	 ORDER BY genreName; ";
	$result = mysqli_query($db_link,$query);

	print( "\tWhat Genre do you want to search by?</br>
		<select name=form_genre>");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("<option value=\"$line[0]\">$line[0]</option>\n");
	} // end of while

	print("</select></p><p>How do you want to sort?</br>\n
		<select name=form_sort>
		<option value=\"Release Date\">Release Date</option>\n
		<option value=\"Name\">Name</option>\n
		<option value=\"State\">Development State</option>\n
		<option value=\"Score\">Score</option>\n
		");


	print("</select>");

	print("</p><p>
		<select name=form_sortBy>
		<option value=\"ASC\">Ascending</option>\n
		<option value=\"DESC\">Descending</option>\n
		</select>\n
	     <input type=submit value=Submit>
	     <input type=reset value=Cancel>
	     </p>" );

	/* Free resultset */
	  mysqli_free_result($result);

	 /* Closing connection */
	mysqli_close($db_link);
?>

</form>
</div>
</body>
