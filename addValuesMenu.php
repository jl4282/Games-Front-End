<?php
	print( "<html>\n
\n<head>
\n  <title>Select games from Database</title>
\n  <link href=\"php_mysql.css\" rel=\"stylesheet\" type=\"text/css\" />
\n  </head>\n
	<body>\n
	<div id = \"content\"><h1>Input a New Game</h1><br />
	  <form action=\"addValuesFinal.php\" method=\"post\">");

	include ('/home/jl4282/jl_config.php');

	/* Note: nl2br inserts HTML line breaks before all newlines in a string */
	$db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
	if ($db_link->connect_errno) {
		print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
	}
	/* print("<p>Connection: ".$db_link->host_info . "<br />\n"); */
	/* print( nl2br("Connected successfully\n"));                 */

	/*name*/
	print("\n<div id = \"game\">Name: 
		\t<input type=\"text\" name = \"form_name\" maxlength=\"150\"></input></br>\n");

	print("\tAbbreviated Name: (ex: Halo: Combat Evolved might be Halo:CE)
		\t<input type=\"text\" name = \"form_abrname\" maxlength=\"30\"></input></br>\n");
	/*link to images*/
	print("\tCover Image, Pleaes ONLY SUBMIT URLS ENDING IN jpg: 
		\t<input type=\"url\" name = \"form_image\"></input></br>\n");

	/*releaseDate -> in specific form*/
	print("\tReleaes Date: 
		\t<input type=\"date\" name = \"form_date\"></input></br>\n");
	/*metacriticScore -> number*/
	print("\tEnter a score 0-10 no decimal values: 
		\t<input type=\"number\" name = \"form_score\" min =\"0\" max =\"10\" ></input></br>\n");
	print("</select>");
	/*state -> controlled vocabulary*/
	$query =
	"SELECT stateName
	 FROM state
	 ORDER BY stateName; ";
	$result = mysqli_query($db_link,$query);

	print( "State in Development of Game
		<select name=form_state>");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("<option value=\"$line[0]\">$line[0]</option>\n");
	} // end of while
	print( "</select><p></p>");
	
	/*link -> link to wikipedia page*/
	print("Link to Game's Wikipedia or Giantbomb page: 
		\t<input type=\"url\" name = \"form_wiki\"></input></br>\n
		</div>");


	/*Get genres to add*/
	$query =
	"SELECT genreName 
	 FROM genre
	 ORDER BY genreName; ";
	$result = mysqli_query($db_link,$query);

	print( "Select Game Genres</br>\n");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("\t<input type=\"checkbox\" name=form_genre[]\" value=\"$line[0]\">$line[0]</input></br>\n");
	} // end of while

	print("</p><p>");

	/*platforms*/
	$query =
	"SELECT platformsShort 
	 FROM platforms
	 ORDER BY platformsShort; ";
	$result = mysqli_query($db_link,$query);

	print( "Select Game Platforms</br>\n");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("\t<input type=\"checkbox\" name=form_platforms[]\" value=\"$line[0]\">$line[0]</input></br>\n");
	} // end of while
	print("<p></p>");
	/*Developer*/
	$query =
	"SELECT name 
	 FROM company
	 WHERE type = \"Developer\"
	 ORDER BY name; ";
	$result = mysqli_query($db_link,$query);

	print( "Select Game Developers</br>\n");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("\t<input type=\"checkbox\" name=form_developer[]\" value=\"$line[0]\">$line[0]</input></br>\n");
	} // end of while


	/*Publisher*/
	print("<p></p>");
	$query =
	"SELECT name 
	 FROM company
	 WHERE type = \"Publisher\"
	 ORDER BY name; ";
	$result = mysqli_query($db_link,$query);

	print( "Select Game Publishers</br>\n");
	while ($line = mysqli_fetch_array($result, MYSQL_NUM)) { 
	    print("\t<input type=\"checkbox\" name=form_publisher[]\" value=\"$line[0]\">$line[0]</input></br>\n");
	} // end of while

	print("
	     <input type=submit value=Submit>
	     <input type=reset value=Cancel>
	     </p>
	     </form>" );

	/* Free resultset */
	  mysqli_free_result($result);

	 /* Closing connection */
	mysqli_close($db_link);
?>

</form>
</body>