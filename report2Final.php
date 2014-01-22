<html>
  <head>
    <title>Games by Genre</title>
    <link href="php_mysql.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id = "content">
    <?php

    /*ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL);

    /* this variable is from the HTML form: */
    $genre = $_POST['form_genre'] ;
    $sort = $_POST['form_sort'];
    $sortBy = $_POST['form_sortBy'];
    if($sort == "Release Date"){
      $sort = "ORDER BY games.releaseDate";
    }
    else if ($sort == "Name"){
      $sort = "ORDER BY games.name";
    }
    else if ($sort == "State"){
      $sort = "ORDER BY games.state";
    }
    else if ($sort == "Score"){
      $sort = "ORDER BY games.metacriticScore";
    }
    print("<h1>$genre Games On File</h1>\n<hr />\n");

    include ('/home/jl4282/jl_config.php');

    /* Note: nl2br inserts HTML line breaks before all newlines in a string */
    $db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
    if ($db_link->connect_errno) {
      print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
    }
    /*print("<p>Connection: ".$db_link->host_info . "<br />\n");
    print( nl2br("Connected successfully\n")); */

    /* Performing SQL query using criteria supplied by the user on the HTML form */
    /*fix select Query!!!*/
    $query = "SELECT games.images, games.link, games.name, games.releaseDate, games.metacriticScore, games.state 
    FROM games games 
    INNER JOIN genresPerGame genresPerGame ON games.ID = genresPerGame.gameID
    INNER JOIN genre genre ON genresPerGame.genre = genre.genreName
    WHERE '".$genre."' = genresPerGame.genre ".$sort." ".$sortBy;

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
        print("<p>No records were found that match your criteria. Why not <a href=\"addValuesMenu.php\">add some</a> games? Or if you'd like, try <a href = \"report2Menu.php\">searching something else.</a></p>\n");
    }
    
    /*if ($rows_found >0) {
    /* Printing results in HTML */
      /*print("<table border='3' width ='60%' >\n
            \t<tr>\n
            \t\t<th>Images</th>\n
            \t\t<th>Title</th>\n
            \t\t<th>Release Date</th>\n
            \t\t<th>Genres</th>\n
            \t</tr>\n");
      
       while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
          
          print( "\t<tr>\n");
          foreach ($line as $col_value) {
            if ((strlen($col_value)>=4)&&(substr( $col_value, 0, 4) == "img_")) 
              print("\t\t<td><img src=\"$col_value\"></td>\n");
            else
              print("\t\t<td>$col_value</td>\n");
          } // end of foreach
        }
          print("\t</tr>\n");
    }
      print("</table><br />\n");
         
        print("Records found that match this query: $rows_found \n");
    else
    {
        print("<p>No records were found that match your criteria.</p>\n");
    }
      /* Free resultset */
      mysqli_free_result($result);

     /* Closing connection */
    mysqli_close($db_link);
     ?>

   </div>
  </body>
</html>

