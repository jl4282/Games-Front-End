<?php
  print( "<html>\n
\n<head>
\n  <title>Newly Added</title>
\n  <link href=\"php_mysql.css\" rel=\"stylesheet\" type=\"text/css\" />
\n  </head>\n
  <body>\n
    <div id=\"content\" >
    <h1>Games Recently Added:</h1><br />");

  include ('/home/jl4282/jl_config.php');

  /* Note: nl2br inserts HTML line breaks before all newlines in a string */
  $db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
  if ($db_link->connect_errno) {
    print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
  }
  /* print("<p>Connection: ".$db_link->host_info . "<br />\n"); */
  /* print( nl2br("Connected successfully\n"));                 */



  $query = "SELECT ID FROM userCreated;";
  $result2 = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());
  $rows_found2 =mysqli_num_rows($result2);
  if ($rows_found2 >0)   {
    
    while ($line2 = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
      foreach ($line2 as $col2) {
        $query = "SELECT games.images, games.link, games.name, games.releaseDate, games.metacriticScore, games.state
  FROM games
  INNER JOIN userCreated userCreated ON games.ID = userCreated.ID
  WHERE userCreated.ID = '$col2'
  ORDER BY games.name;";
        print($query);
        $link = "";
        $link_found = "False";
        $result = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());

        $rows_found =mysqli_num_rows($result);
        if ($rows_found >0)   {
          print("<table border='3' width ='60%' >\n
                  \t<tr>\n
                  \t\t<th>Images</th>\n
                  \t\t<th>Title</th>\n
                  \t\t<th>Release Date</th>\n
                  \t\t<th>Metacritic Score</th>\n
                  \t\t<th>Game State</th>\n
                  \t</tr>\n");
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print( "\t<tr>\n");
            $counter = 1;
            foreach ($line as $col_value) {
              if($counter == 1){ 
                    print("\t\t<td><img src=\"$col_value\"></td>\n");
                    $counter = $counter + 1;
              }
              else if ((strlen($col_value)>=4)&&(substr( $col_value, 0, 4) == "http")){ 
                    $link = $col_value;
                    $link_found = "True";
              }
              else if($link_found == "True"){
                    print("\t\t<td><a href=\"$link\" target=\"_blank\">$col_value</td>\n");
                    $link_found = "False";
              }
              else
                    print("\t\t<td>$col_value</td>\n");
            }
            print("\t</tr>\n");
          }
          print("</table><br />\n");
               
          print("<p>Records found that match this query: $rows_found \n");
        }
        else
        {
            print("<p>No records were found that match your criteria.</p>\n");
        }


        /*genres */
        $query = "SELECT genresPerGame.genre
  FROM genresPerGame
  INNER JOIN userCreated userCreated ON genresPerGame.gameID = userCreated.ID
  WHERE userCreated.ID = '$col2'
  ORDER BY genresPerGame.genre;";
        print($query);
        $link = "";
        $link_found = "False";
        $result = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());

        $rows_found =mysqli_num_rows($result);
        if ($rows_found >0)   {
          print("<table border='3' width ='60%' >\n
                  \t<tr>\n
                  \t\t<th>Genres</th>\n
                  \t</tr>\n");
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print( "\t<tr>\n");
            $counter = 1;
            foreach ($line as $col_value) {
              print("\t\t<td>$col_value</td>\n");
            }
            print("\t</tr>\n");
          }
          print("</table><br />\n");
               
          print("<p>Records found that match this query: $rows_found \n");
        }
        else
        {
            print("<p>No records were found that match your criteria.</p>\n");
        }


        /* publishersPerGame */
        $query = "SELECT publishersPerGame.publisher
  FROM publishersPerGame
  INNER JOIN userCreated userCreated ON publishersPerGame.gameID = userCreated.ID
  WHERE userCreated.ID = '$col2'
  ORDER BY publishersPerGame.publisher;";
        print($query);
        $link = "";
        $link_found = "False";
        $result = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());

        $rows_found =mysqli_num_rows($result);
        if ($rows_found >0)   {
          print("<table border='3' width ='60%' >\n
                  \t<tr>\n
                  \t\t<th>Publishers</th>\n
                  \t</tr>\n");
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print( "\t<tr>\n");
            $counter = 1;
            foreach ($line as $col_value) {
              print("\t\t<td>$col_value</td>\n");
            }
            print("\t</tr>\n");
          }
          print("</table><br />\n");
               
          print("<p>Records found that match this query: $rows_found \n");
        }
        else
        {
            print("<p>No records were found that match your criteria.</p>\n");
        }


        /* developers per game */
        $query = "SELECT developersPerGame.developer
  FROM developersPerGame
  INNER JOIN userCreated userCreated ON developersPerGame.gameID = userCreated.ID
  WHERE userCreated.ID = '$col2'
  ORDER BY developersPerGame.developer;";
        print($query);
        $link = "";
        $link_found = "False";
        $result = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());

        $rows_found =mysqli_num_rows($result);
        if ($rows_found >0)   {
          print("<table border='3' width ='60%' >\n
                  \t<tr>\n
                  \t\t<th>Developers</th>\n
                  \t</tr>\n");
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print( "\t<tr>\n");
            $counter = 1;
            foreach ($line as $col_value) {
              print("\t\t<td>$col_value</td>\n");
            }
            print("\t</tr>\n");
          }
          print("</table><br />\n");
               
          print("<p>Records found that match this query: $rows_found \n");
        }
        else
        {
            print("<p>No records were found that match your criteria.</p>\n");
        }


        /* platforms Per game */
        $query = "SELECT platformsPerGame.platform
  FROM platformsPerGame
  INNER JOIN userCreated userCreated ON platformsPerGame.gameID = userCreated.ID
  WHERE userCreated.ID = '$col2'
  ORDER BY platformsPerGame.platform;";
        print($query);
        $link = "";
        $link_found = "False";
        $result = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());

        $rows_found =mysqli_num_rows($result);
        if ($rows_found >0)   {
          print("<table border='3' width ='60%' >\n
                  \t<tr>\n
                  \t\t<th>Platforms</th>\n
                  \t</tr>\n");
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print( "\t<tr>\n");
            $counter = 1;
            foreach ($line as $col_value) {
              print("\t\t<td>$col_value</td>\n");
            }
            print("\t</tr>\n");
          }
          print("</table><br />\n");
               
          print("<p>Records found that match this query: $rows_found \n");
        }
        else
        {
            print("<p>No records were found that match your criteria.</p>\n
              ");
        }


      }//end foreach
    }/*end of while loop*/
  }
  else
  {
     print("<p>You haven't input anything! Why not <a href=\"addValuesMenu.php\">add
      some</a> games? Or if you'd like, try <a href = \"report2Menu.php\">
      searching something else.</a></p>\n");
  }
  mysqli_free_result($result2);


   /* Closing connection */
  mysqli_close($db_link);
?>
</div>
</body>

