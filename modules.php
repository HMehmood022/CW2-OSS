<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Build SQL statement that selects a student's modules
    $sql = "SELECT * FROM studentmodules sm INNER JOIN module m ON m.modulecode = sm.modulecode WHERE sm.studentid = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($conn, $sql);

    // Prepare page content 
    $data['content'] .= "<div class='container mt-5'>";
    $data['content'] .= "<h2>Modules</h2>";
    $data['content'] .= "<table class='table table-bordered'>";
    $data['content'] .= "<thead class='thead-dark'>";
    $data['content'] .= "<tr><th>Code</th><th>Type</th><th>Level</th></tr></thead><tbody>";

    // Display the modules within the HTML table
    while ($row = mysqli_fetch_assoc($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>{$row['modulecode']}</td>";
        $data['content'] .= "<td>{$row['name']}</td>";
        $data['content'] .= "<td>{$row['level']}</td>";
        $data['content'] .= "</tr>";
    }

    $data['content'] .= "</tbody></table>";
    $data['content'] .= "</div>"; // closes container

    // Render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
    exit(); // kills script after the redirect
}

echo template("templates/partials/footer.php");
?>

