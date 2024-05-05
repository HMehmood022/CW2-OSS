<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = mysqli_real_escape_string($conn, $_POST['studentid']); // mysqli_escape_string is used to protect agaaints SQL injection attacks
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hashes the passowrd so that it isn't stored in plaintext
    $house = mysqli_real_escape_string($conn, $_POST['house']);
    $town = mysqli_real_escape_string($conn, $_POST['town']);
    $county = mysqli_real_escape_string($conn, $_POST['county']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

    // validation, the user is asked to fill in all fields.
    if (empty($studentid) . empty($firstname) . empty($lastname) . empty($dob) . empty($_POST['password'])) {
        echo "<p>Missing fields, please fill in all required fields.</p>";
    } else {
        $sql = "INSERT INTO student (studentid, firstname, lastname, dob, password, house, town, county, country, postcode) 
                VALUES ('$studentid', '$firstname', '$lastname', '$dob', '$password', '$house', '$town', '$county', '$country', '$postcode')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<p>The student record was inserted successfully.</p>";
            header("Location: students.php");
        }
    }
}

echo template("templates/partials/footer.php");
?>
<!-- html table for the form-->
<h2>Add New Student</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!---protects againts cross site script attacks by preventing special characters -->
    Student ID: <input type="text" name="studentid"><br>
    First Name: <input type="text" name="firstname"><br>
    Last Name: <input type="text" name="lastname"><br>
    Date of Birth: <input type="date" name="dob"><br> <!--The type "date" allows the user to select their date of birth using a calander-->
    Password: <input type="password" name="password"><br>
    House: <input type="text" name="house"><br>
    Town: <input type="text" name="town"><br>
    County: <input type="text" name="county"><br>
    Country: <input type="text" name="country"><br>
    Postcode: <input type="text" name="postcode"><br>
    <input type="submit" name="submit" value="Save">
</form>
