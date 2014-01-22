
<?php
	print( "<html>\n
\n<head>
\n  <title>Select Companies by Region </title>
\n  <link href=\"php_mysql.css\" rel=\"stylesheet\" type=\"text/css\" />
\n  </head>\n
	<body>\n
	<div id = \"content\">
		<h1>Select a Company By Region:</h2><br />
	  <form action=\"report1Final.php\" method=\"post\">
	  Companies from which region?</br>");

	include ('/home/jl4282/jl_config.php');

	/* Note: nl2br inserts HTML line breaks before all newlines in a string */
	$db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
	if ($db_link->connect_errno) {
		print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
	}
	/* print("<p>Connection: ".$db_link->host_info . "<br />\n"); */
	/* print( nl2br("Connected successfully\n"));                 */


	$query =
	"SELECT region 
	 FROM company
	 GROUP BY region
	 ORDER BY region; ";
	$result = mysqli_query($db_link,$query);

	print( "<select name=form_region>");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("<option value=\"$line[0]\">$line[0]</option>\n");
	} // end of while

	print("</select>");

	print("</p><p>
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