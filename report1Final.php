<html>
  <head>
    <title>Companies by Region</title>
    <link href="php_mysql.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id = "content">
    <?php

    /* this variable is from the HTML form: */
    $region = $_POST['form_region'] ;
    print("<h1>Companies located in $region</h1>\n<hr />\n");

    include ('/home/jl4282/jl_config.php');

    /* Note: nl2br inserts HTML line breaks before all newlines in a string */
    $db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
    if ($db_link->connect_errno) {
      print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
    }
    /*print("<p>Connection: ".$db_link->host_info . "<br />\n");
    print( nl2br("Connected successfully\n"));*/

    /* Performing SQL query using criteria supplied by the user on the HTML form */
    /*fix select Query!!!*/
    $query = "SELECT * FROM company WHERE region='$region' ORDER BY name";
    $result = mysqli_query($db_link,$query) or die("Query failed : " . mysql_error());

    $rows_found =mysqli_num_rows($result);

    if ($rows_found >0) {
    /* Printing results in HTML */
      print("<table border='3' width ='60%' >\n
            \t<tr>\n
            \t\t<th>Company</th>\n
            \t\t<th>Shorthand</th>\n
            \t\t<th>Type</th>\n
            \t\t<th>Region</th>\n
            \t</tr>\n");
      
       while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
          
          print( "\t<tr>\n");
          foreach ($line as $col_value) {
          	print("\t\t<td>$col_value</td>\n");
            }
          print("\t</tr>\n");
        }
      print("</table><br />\n");
         
        print("Records found that match this query: $rows_found \n");
      }
    else
      {
        print("<p>No records were found that match your criteria. Why not <a href=\"addValuesMenu.php\">add some</a> games? Or if you'd like, try <a href = \"report2Menu.php\">searching something else.</a></p>\n");
       }
      /* Free resultset */
      mysqli_free_result($result);

     /* Closing connection */
    mysqli_close($db_link);
     ?>
   </div>
  </body>
</html>

