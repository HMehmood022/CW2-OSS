<?php
// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_POST['delbttn']) && isset($_POST['students'])) {
    // Retrieve  studentIDs to delete
    $delStudents = $_POST['students'];

    // Loop through selected studentID
    foreach ($delStudents as $studentId) {
        $sql_delete = "DELETE FROM student WHERE studentid = ?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("i", $studentId); 
        $stmt->execute(); 
        $stmt->close(); 
    }

    // Redirect back to students.php after deleting is complete
    header("Location: students.php");
    exit(); // Kill the script after redicrect
} else {

    header("Location: index.php");
    exit(); // kill script after redirect
}
?>


