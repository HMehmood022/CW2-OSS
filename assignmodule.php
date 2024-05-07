<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // If a module has been selected
    if (isset($_POST['selmodule'])) {
        $moduleCode = mysqli_real_escape_string($conn, $_POST['selmodule']);

        // Insert selected module into studentmodules table
        $sql = "INSERT INTO studentmodules (studentid, modulecode) VALUES ('" . $_SESSION['id'] . "', '$moduleCode')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $data['content'] .= "<div class='alert alert-success' role='alert'>The module $moduleCode has been assigned to you.</div>";
        } else {
            $data['content'] .= "<div class='alert alert-danger' role='alert'>Error assigning module. Please try again.</div>";
        }
    } else {
        // Fetch all modules from the database
        $sql = "SELECT * FROM module";
        $result = mysqli_query($conn, $sql);

        // Display module selection form
        $data['content'] .= "<div class='container mt-5'>";
        $data['content'] .= "<form name='frmassignmodule' action='' method='post'>";
        $data['content'] .= "<label for='selmodule' class='form-label'>Select a module to assign:</label>";
        $data['content'] .= "<select class='form-select' name='selmodule'>";
        
        // Display modules in a dropdown selection box
        while ($row = mysqli_fetch_assoc($result)) {
            $data['content'] .= "<option value='{$row['modulecode']}'>{$row['name']}</option>";
        }

        $data['content'] .= "</select>";
        $data['content'] .= "<button type='submit' class='btn btn-primary mt-3' name='confirm'>Save</button>";
        $data['content'] .= "</form>";
        $data['content'] .= "</div>"; // close container
    }

    // Render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
    exit(); // stop script execution after redirection
}

echo template("templates/partials/footer.php");
?>
