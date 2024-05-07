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

// Handles the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // MYSQLI real escape string defends againts sql injection attacks
    $studentid = mysqli_real_escape_string($conn, $_POST['studentid']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $house = mysqli_real_escape_string($conn, $_POST['house']);
    $town = mysqli_real_escape_string($conn, $_POST['town']);
    $county = mysqli_real_escape_string($conn, $_POST['county']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

    // validation, user is asked to input data
    if (empty($studentid) || empty($firstname) || empty($lastname) || empty($dob) || empty($_POST['password'])) {
        echo "<div class='alert alert-danger'>Missing fields, please fill in all required fields.</div>";
    } else {
        // File upload configuration
        $file_dir = "img/";
        $file_target = $file_dir . basename($_FILES["student_pic"]["name"]);

        if (move_uploaded_file($_FILES["student_pic"]["tmp_name"], $file_target)) {
            // Insert student record into database
            $sql_insert = "INSERT INTO student (studentid, firstname, lastname, dob, password, house, town, county, country, postcode, photo_path) 
                VALUES ('$studentid', '$firstname', '$lastname', '$dob', '$password', '$house', '$town', '$county', '$country', '$postcode', '$file_target')";

            if (mysqli_query($conn, $sql_insert)) {
                echo "<div class='alert alert-success'>The student record was inserted successfully.</div>";
                header("Location: students.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Error inserting the student record: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>File upload failed.</div>";
        }
    }
}

?>

<!-- HTML form with Bootstrap styling -->
<div class="container mt-5">
    <h2>Add New Student</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label for="studentid" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentid" name="studentid">
            </div>
            <div class="col-md-6">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="house" class="form-label">House</label>
                <input type="text" class="form-control" id="house" name="house">
            </div>
            <div class="col-md-6">
                <label for="town" class="form-label">Town</label>
                <input type="text" class="form-control" id="town" name="town">
            </div>
            <div class="col-md-4">
                <label for="county" class="form-label">County</label>
                <input type="text" class="form-control" id="county" name="county">
            </div>
            <div class="col-md-4">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country">
            </div>
            <div class="col-md-4">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="postcode" name="postcode">
            </div>
            <div class="col-md-12">
                <label for="student_pic" class="form-label">Upload Student Photo</label>
                <input type="file" class="form-control" id="student_pic" name="student_pic" accept="image/*"> 
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>

<?php
echo template("templates/partials/footer.php");
?>
