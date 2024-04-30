<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statement that 
      $sql_select = "SELECT studentid, firstname, lastname FROM student";
      $result = mysqli_query($conn, $sql_select);

    

   }

?>
