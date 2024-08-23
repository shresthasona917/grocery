<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to your database (example using MySQLi)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "developers";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   

    // Get the property ID from the submitted form
    $property_id = $_POST['property_id'];

    // Perform the deletion query
    $sql = "DELETE FROM booking WHERE pid = '$property_id'";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "success";
    } else {
        // Error handling if the deletion fails
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>