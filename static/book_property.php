<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    session_start();
    include("config.php");
    if (isset($_SESSION['uid'])) {
        // Get the property ID from the POST data
        $propertyId = $_POST['property_id'];

        // You may need additional data such as user ID, booking date, etc.
        // For example, you can store the user ID from the session.
        $userId = $_SESSION['uid'];
        $bookingDate = date('Y-m-d'); // Optionally, you can store the booking date as well.

        // Connect to the database (replace 'localhost', 'username', 'password', and 'property_bookings' with your actual database credentials)
        $conn = new mysqli('localhost', 'root', '', 'developers');

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $stmt = $conn->prepare("INSERT INTO booking (pid, uid, booking_date) VALUES (?, ?, ?)");
        if (!$stmt) {
            // Handle SQL error
            die("Error preparing SQL statement: " . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("iis", $propertyId, $userId, $bookingDate); // Assuming $bookingDate is the date value
        if (!$stmt->execute()) {
            // Handle execution error
            die("Error executing SQL statement: " . $stmt->error);
        }

        // Success message
        // echo json_encode(['status' => 'success', 'message' => 'Property booked successfully.']);
        echo json_encode(['status' => 'success', 'message' => 'Property booked successfully.']);

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();

    } else {
        // User is not logged in
        http_response_code(401); // Unauthorized
        echo json_encode(['status' => 'error', 'message' => 'Please log in to book the property.']);
    }
} else {
    // Method not allowed
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}
?>