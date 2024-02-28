<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "test"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO rdetails (name, hostelid, block, roomno, assistantdirector, daysLeaving) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $name, $hostelid, $block, $roomno, $assistantdirector, $daysLeaving);

    // Sanitize and validate form data
    $name = $_POST['name'];
    $hostelid = $_POST['hostelid'];
    $block = $_POST['block'];
    $roomno = $_POST['roomno'];
    $assistantdirector = $_POST['assistantdirector'];
    $daysLeaving = $_POST['daysLeaving'];

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Output success message using JavaScript alert
        echo '<script>alert("Applied Reduction successfully"); window.location.href = "dashboard.html"</script>';
    } else {
        // Output error message using JavaScript alert
        echo '<script>alert("Error: ' . $stmt->error . '");</script>';
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
