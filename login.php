<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are provided
    $email = !empty($_POST["email"]) ? $_POST["email"] : null;
    $password = !empty($_POST["password"]) ? $_POST["password"] : null;

    if ($email !== null && $password !== null) {
        // Prepare and execute statement
        $stmt = $conn->prepare("SELECT email, password FROM details WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch email and password from the result
            $row = $result->fetch_assoc();
            $storedEmail = $row["email"];
            $storedPassword = $row["password"];

            // Verify password
            if ($password === $storedPassword) {
                // Password is correct, proceed with login
                echo "<script>alert('Login successful. Welcome, $storedEmail!'); window.location = 'dashboard.html';</script>";
                exit; // Stop further execution
            } else {
                // Password is incorrect, redirect to index.html
                echo "<script>alert('Incorrect password'); window.location = 'index.html';</script>";
                exit; // Stop further execution
            }
        } else {
            // Email does not exist
            echo "<script>alert('Email does not exist or incorrect password.'); window.location = 'index.html';</script>";
            exit; // Stop further execution
        }

        // Close statement
        $stmt->close();
    } else {
        // If email or password is empty
        echo "<script>alert('Please enter both email and password.'); window.location = 'index.html';</script>";
        exit; // Stop further execution
    }
}

// Close database connection
$conn->close();
?>
