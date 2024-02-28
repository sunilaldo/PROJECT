<?php
$host = "localhost";
$dbname = "test";
$username = "root";
$password = "";

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form values
$hostelId = $_POST['hostelid'];
$name = $_POST['name'];
$messType = $_POST['messType'];

// Prepare and execute SQL query to insert values into the database
$sql = "INSERT INTO cdetails VALUES ('$hostelId', '$name', '$messType')";

if ($conn->query($sql) === TRUE) {
    // Output success message using JavaScript alert
    echo '<script>alert("Coupon Registered successfully"); window.location.href = "dashboard.html"</script>';
} else {
    // Output error message using JavaScript alert
    echo '<script>alert("Error: ' . $sql . '\\n' . $conn->error . '");</script>';
}

// Close the database connection
$conn->close();
?>
