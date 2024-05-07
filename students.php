<?php
include ("_includes/config.inc");
include ("_includes/dbconnect.inc");
include ("_includes/functions.inc");

// Check if user is logged in
if (isset($_SESSION['id'])) {
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Display student information in a responsive grid
   $data['content'] .= "<form class='row g-3' action='deletestudents.php' method='POST'>";

   // Fetch student data from the database
   $sql_select = "SELECT * FROM student";
   $result = mysqli_query($conn, $sql_select);

   while ($row = mysqli_fetch_assoc($result)) {

      $data['content'] .= "
            <div class='col-md-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Student ID: {$row['studentid']}</h5>
                        <p class='card-text'>Name: {$row['firstname']} {$row['lastname']}</p>
                        <p class='card-text'>DOB: {$row['dob']}</p>
                        <p class='card-text'>Address: {$row['house']}, {$row['town']}, {$row['county']}</p>
                        <p class='card-text'>Country: {$row['country']}, {$row['postcode']}</p>
                        <img src='{$row['photo_path']}' class='img-thumbnail' width='100' height='100' alt='Student Photo'>
                        <div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='students[]' value='{$row['studentid']}' id='student{$row['studentid']}'>
                            <label class='form-check-label' for='student{$row['studentid']}'>Select to delete</label>
                        </div>
                    </div>
                </div>
            </div>";
   }

   // Add submit button within the form
   $data['content'] .= "
        <div class='col-12'>
            <button type='submit' name='delbttn' class='btn btn-danger'>Delete Selected</button>
        </div>";

   $data['content'] .= "</form>";

   // Render the page using the default template
   echo template("templates/default.php", $data);
} else {
   header("Location: index.php"); // Redirect to index.php if not logged in
}
?>