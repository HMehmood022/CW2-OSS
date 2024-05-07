<?php

include ("_includes/config.inc");
include ("_includes/dbconnect.inc");
include ("_includes/functions.inc");

//checks to see if we are logged in
if (isset($_SESSION['id'])) {

   //build and run insert query x5

   $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('20001643', 'mypassword1',  '2004-04-04', 'David', 'Brent', '124 addresslane', 'Chesham', 'Bucks', 'GB', 'HP2 34C')";
   $result = mysqli_query($conn, $sql);

   $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('21235465', 'mypassword2',  '2005-05-05', 'Gareth', 'Keenan', '125 addresslane', 'Chesham', 'Bucks', 'GB', 'HP3 45D')";
   $result = mysqli_query($conn, $sql);

   $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
   VALUES ('22126084', 'mypassword3',  '2003-03-03', 'Hishaam', 'Mehmood', '123 addresslane', 'Chesham', 'Bucks','GB', 'HP1 23B')";
      $result = mysqli_query($conn, $sql);

      $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
      VALUES ('22456690', 'mypassword4',  '2007-07-07', 'Dawn', 'Tinsley', '127 addresslane', 'Chesham', 'Bucks', 'GB', 'HP6 67F')";
         $result = mysqli_query($conn, $sql);
      
   $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode)
VALUES ('22566645', 'mypassword5',  '2006-06-06', 'Tim', 'Canterbury', '126 addresslane', 'Chesham', 'Bucks', 'GB', 'HP5 56E')";
   $result = mysqli_query($conn, $sql);

   echo $sql; // used to see if the query is running

}

?>



