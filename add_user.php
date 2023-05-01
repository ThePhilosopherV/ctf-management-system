<?php
include 'db_connect.php';

        // Check if the form has been submitted
        
        
        // Get the input data from the form
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
    
        // Validate the input data
        if (empty($username)) {
        $error_message = "Username is required.";
        } elseif (empty($password)) {
        $error_message = "Password is required.";
        } elseif ($password != $confirm_password) {
        $error_message = "Passwords do not match.";
        } else {
    
        // Hash the password using MD5
        $hashed_password = md5($password);
    
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, pass_md5) VALUES ('$username', '$hashed_password')";
    
        if ($conn->query($sql) === TRUE) {
            // User has been registered successfully
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
        }
        
        
        // Close the database connection
        $conn->close();
?>