<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $enteredFullName = $_POST['username'];
    $enteredEmail = $_POST['email'];
    $enteredPassword = $_POST['password'];
    $enteredConfirmPassword = $_POST['confirm-password'];

    // Basic input validation - you should implement more robust validation/sanitization
    if (!empty($enteredFullName) && !empty($enteredEmail) && !empty($enteredPassword) && ($enteredPassword == $enteredConfirmPassword)) {
        $query = "INSERT INTO details(username, email, password) VALUES ('$enteredFullName', '$enteredEmail', '$enteredPassword')";

        if ($conn->query($query) === TRUE) {
            echo '<script>alert("Account created successfully!"); window.location.href = "login.html";</script>';
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill in all the fields and make sure the passwords match.";
    }

    $conn->close();
}
?>