<?php

include ("_includes/config.inc");
include ("_includes/dbconnect.inc");
include ("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // prepare table
   $data['content'] .= "<table border='2'>";
   $data['content'] .= "<tr><th>StudentID</th> <th>Firstname</th</tr>";
   $data['content'] .= "<th>Lastname</th>";
   $data['content'] .= "<th>dob</th>";
   $data['content'] .= "<th>Password</th>";
   $data['content'] .= "<th>House</th>"; 
   $data['content'] .= "<th>Town</th>";
   $data['content'] .= "<th>County</th>";
   $data['content'] .= "<th>Country</th>";
   $data['content'] .= "<th>Postcode</th>";

   // SQL statement that selects from the student table
   $sql_select = "SELECT * FROM student";
   $result = mysqli_query($conn, $sql_select);
   // displays the rows in the student table.
   while ($row = mysqli_fetch_assoc($result)) {

      $data['content'] .= "<tr><td> $row[studentid] </td>";
      $data['content'] .= "<td> $row[firstname] </td>";
      $data['content'] .= "<td> $row[lastname] </td>";
      $data['content'] .= "<td> $row[dob] </td>";
      $data['content'] .= "<td align='center'> $row[password] </td>"; //center aligned the passwords.
      $data['content'] .= "<td> $row[house] </td>";
      $data['content'] .= "<td> $row[town] </td>";
      $data['content'] .= "<td> $row[county] </td>";
      $data['content'] .= "<td> $row[country] </td>";
      $data['content'] .= "<td> $row[postcode] </td>";

   }
   }
   $data['content'] .= "</table>"; 

   //render table
   echo template("templates/default.php", $data);






