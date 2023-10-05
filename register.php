<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Create a database connection (replace with your actual credentials)
    $conn = new mysqli('localhost', 'root', '', 'hms');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and execute the SQL query to insert the user into the "usuario" table
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, username, passw) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $username, $hashedPassword);
    
    if ($stmt->execute()) {
        echo 'success'; // Registration successful
    } else {
        echo 'error'; // Registration failed
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request';
}