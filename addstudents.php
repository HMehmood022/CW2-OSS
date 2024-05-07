<?php
include ("_includes/config.inc");
include ("_includes/dbconnect.inc");
include ("_includes/functions.inc");

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}

echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

// this handles the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = mysqli_real_escape_string($conn, $_POST['studentid']); // mysqli_escape_string is used to protect agaaints SQL injection attacks
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hashes/encrypts the passowrd so that it isn't stored in plaintext
    $house = mysqli_real_escape_string($conn, $_POST['house']);
    $town = mysqli_real_escape_string($conn, $_POST['town']);
    $county = mysqli_real_escape_string($conn, $_POST['county']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

    // validation, the user is asked to fill in all fields.
    if (empty($studentid) . empty($firstname) . empty($lastname) . empty($dob) . empty($_POST['password'])) {
        echo "<p>Missing fields, please fill in all required fields.</p>";
    } else {
        // file upload 
        $file_dir = "img";// this is where the student pics will be uploaded.
        $file_target = $file_dir . basename($_FILES["student_pic"]["name"]);
        // Move the uploaded file to the directory we set above
        if (move_uploaded_file($_FILES["student_pic"]["tmp_name"], $file_target)) {

            // if all fields are successfully validated, the data inserted into the db
            $sql_insert = "INSERT INTO student (studentid, firstname, lastname, dob, password, house, town, county, country, postcode, photo_path) 
                VALUES ('$studentid', '$firstname', '$lastname', '$dob', '$password', '$house', '$town', '$county', '$country', '$postcode', '$file_target')";

            if (mysqli_query($conn, $sql_insert)) { // if the query is run successfully, the following message is output.
                echo "<p>The student record was inserted successfully.</p>";
                header("Location: students.php"); // redirects back to students.php if successful
                exit(); // exit after redirect
            } else {
                echo "Error inserting the student record: " . mysqli_error($conn); // error message
            }

        } else {
            echo "the file upload failed"; // error message 
        }
    }
}

echo template("templates/partials/footer.php");
?>
<!-- html form for the table-->
<h2>Add New Student</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <!---protects againts cross site script attacks by preventing special characters -->
    Student ID: <input type="text" name="studentid"><br>
    First Name: <input type="text" name="firstname"><br>
    Last Name: <input type="text" name="lastname"><br>
    Date of Birth: <input type="date" name="dob"><br>
    <!--The input type "date" allows the user to select their date of birth using a calander-->
    Password: <input type="password" name="password"><br>
    House: <input type="text" name="house"><br>
    Town: <input type="text" name="town"><br>
    County: <input type="text" name="county"><br>
    Country: <input type="text" name="country"><br>
    Postcode: <input type="text" name="postcode"><br>
    <!-- This is the field for file uploading -->
    Upload student photo: <input type="file" name="student_pic" accept="image/*"><br />
    <input type="submit" name="submit" value="Save">



</form>