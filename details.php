<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if user is logged in
if (isset($_SESSION['id'])) {

    // Include header and navigation templates
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Process form submission
    if (isset($_POST['submit'])) {
        // Update student record in database
        $sql = "UPDATE student SET 
            firstname = '" . $_POST['txtfirstname'] . "',
            lastname = '" . $_POST['txtlastname'] . "',
            house = '" . $_POST['txthouse'] . "',
            town = '" . $_POST['txttown'] . "',
            county = '" . $_POST['txtcounty'] . "',
            country = '" . $_POST['txtcountry'] . "',
            postcode = '" . $_POST['txtpostcode'] . "'
            WHERE studentid = '" . $_SESSION['id'] . "'";
        $result = mysqli_query($conn, $sql);

        $data['content'] = "<p>Your details have been updated</p>";
    } else {
        // get student record from db
        $sql = "SELECT * FROM student WHERE studentid='" . $_SESSION['id'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        // HTML table with bootstrap
        $data['content'] = <<<EOD
            <h2>My Details</h2>
            <form name="frmdetails" action="" method="post">
                <div class="form-group">
                    <label for="txtfirstname">First Name:</label>
                    <input class="form-control" name="txtfirstname" type="text" value="{$row['firstname']}" />
                </div>
                <div class="form-group">
                    <label for="txtlastname">Surname:</label>
                    <input class="form-control" name="txtlastname" type="text" value="{$row['lastname']}" />
                </div>
                <div class="form-group">
                    <label for="txthouse">Number and Street:</label>
                    <input class="form-control" name="txthouse" type="text" value="{$row['house']}" />
                </div>
                <div class="form-group">
                    <label for="txttown">Town:</label>
                    <input class="form-control" name="txttown" type="text" value="{$row['town']}" />
                </div>
                <div class="form-group">
                    <label for="txtcounty">County:</label>
                    <input class="form-control" name="txtcounty" type="text" value="{$row['county']}" />
                </div>
                <div class="form-group">
                    <label for="txtcountry">Country:</label>
                    <input class="form-control" name="txtcountry" type="text" value="{$row['country']}" />
                </div>
                <div class="form-group">
                    <label for="txtpostcode">Postcode:</label>
                    <input class="form-control" name="txtpostcode" type="text" value="{$row['postcode']}" />
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Save</button>
            </form>
        EOD;
    }

    // Render the main template with the content
    echo template("templates/default.php", $data);

} else {
    // Redirect to index if not logged in
    header("Location: index.php");
}

// Include footer template
echo template("templates/partials/footer.php");
?>
