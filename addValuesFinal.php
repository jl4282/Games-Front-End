<html>
  <head>
    <title>Values Added</title>
    <link href="php_mysql.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php

    $name = $_POST['form_name'];

    /*get gameID (ID)*/
    $year = substr($_POST['form_date'],0,4);
    $gameID = $_POST['form_abrname']." ".$year;

    /* check image, if not jpg then insert null*/
    $image = $_POST['form_image'];
    if((substr($image, -3)=="jpg" )|| (substr($image, -3)=="Jpg")||(substr($image, -3)=="JPG")){
    }
    else{
      $image = "Null";
    }
    
    /* to insert new games need:
    ID
    name
    images
    releaseDate
    metacriticScore
    state
    */
    $date = $_POST['form_date'];
    $score = $_POST['form_score'];
    $state = $_POST['form_state'];
    $wikiURL = $_POST['form_wiki'];
    $game_query = "INSERT INTO games VALUES ('$gameID',  '$name', '$image', '$date', '$score', '$state', '$wikiURL' );";
    /*print("</br>$game_query");*/
    /*$game_query = "INSERT INTO games VALUES ('".$gameID."',  '".$name."', " $image.", '".$_POST['form_date']."', ".$_POST['form_score'].", '".$_POST['form_state']."', ".$_POST['form_wiki'].");";*/


    

    /*when putting into companies per game use company full name*/







    /*ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
    error_reporting(E_ALL);

    /* this variable is from the HTML form: */
    /*$genre = $_POST['form_genre'] ;
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
    print("<h4>$genre Games On File</h4>\n<hr />\n");*/

    include ('/home/jl4282/jl_config.php');

    /* Note: nl2br inserts HTML line breaks before all newlines in a string */
    $db_link = new mysqli($db_server, $db_user, $db_password, $db_name);
    if ($db_link->connect_errno) {
      print( "Failed to connect to MySQL: (" .$db_link->connect_errno . ") ".$db_link->connect_error);
    }
    /*print("<p>Connection: ".$db_link->host_info . "</br>\n");
    print( nl2br("Connected successfully\n"));*/

    
    $result = mysqli_query($db_link,$game_query) or die("Query failed : " . mysql_error($db_link));
        /*if (!$result){
          mysqli_free_result($result);
        }
        else{
          $rows_found =mysqli_num_rows($result);

          if ($rows_found >0) {
            while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
              print("</br>Query Response: $line");
            }
            
          }
          mysqli_free_result($result);
        }*/



    $genres = $_POST['form_genre'];
    if(!empty($genres)){
      foreach ($genres as $indivGenre) {
        $genre_query = "INSERT INTO genresPerGame VALUES(Null, '$gameID', '$indivGenre');";
        /*print("</br>$genre_query");*/
        $result = mysqli_query($db_link,$genre_query) or die("Query failed : " . mysql_error($db_link));
        /*if (!$result){
          /*mysqli_free_result($result);*/
        /*}
        else{
          $rows_found =mysqli_num_rows($result);

          if ($rows_found >0) {
            while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
              /*print("</br>Query Response: $line");*/
            /*}
            /*mysqli_free_result($result);*/
          /*}
        }*/
      }
    }

    $platforms = $_POST['form_platforms'];
    if(!empty($platforms)){
      foreach ($platforms as $platform) {
        $plat_query = "INSERT INTO platformsPerGame VALUES(Null, '$gameID', '$platform');";
        /*print("</br>$plat_query");*/
        $result = mysqli_query($db_link,$plat_query) or die("Query failed : " . mysql_error());
        /*if ($rows_found >0) {
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            /*print("</br>Query Response: $line");*/
          /*}
          /*mysqli_free_result($result);*/
        /*}*/
      }
    }


    $devs = $_POST['form_developer'];
    if(!empty($devs)){
      foreach ($devs as $dev) {
        $dev_query = "INSERT INTO developersPerGame VALUES(Null, '$gameID', '$dev');";
        /*print("</br>$dev_query");*/
        $result = mysqli_query($db_link,$dev_query) or die("Query failed : " . mysql_error());
        /*if ($rows_found >0) {
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            /*print("</br>Query Response: $line");*/
         /* }
          /*mysqli_free_result($result);*/
    /*    }        */
      }
    }


    $publishers = $_POST['form_publisher'];
    if(!empty($publishers)){
      foreach ($publishers as $publisher) {
        $pub_query = "INSERT INTO publishersPerGame VALUES (Null, '$gameID', '$publisher');";
        /*print("</br>$pub_query");
        $result = mysqli_query($db_link,$pub_query) or die("Query failed : " . mysql_error());
       if ($rows_found >0) {
          while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print("</br>Query Response: $line");
          }
          
        } 
        mysqli_free_result($result);*/
      }
    }

    /*add gameID (ID) to new games table*/

    $newGame_query = "INSERT INTO userCreated VALUES ('$gameID');";
    mysqli_query($db_link,$newGame_query) or die("Query failed : " . mysql_error());


    
      /* Free resultset */
    /*mysqli_free_result($result);*/

     /* Closing connection */
    mysqli_close($db_link);

    print("\t<div id=\"content\">
      \t\t<h1>Thanks for Adding $name</h1>\n
      \t\t\t<p>Want to see all the games you just added? <a href = \"newData.php\">Find out!</a></p>
      \t</div>
      ");


    ?>

  </body>
</html>

