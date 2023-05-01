<?php

include 'db_connect.php';
session_start();
// Get the POST parameters
$username = $_SESSION['user_id'];
$ctf = $_POST["ctf"];
$flag = $_POST["flag"];

// Query the database to get the flag for the given ctf
$ctf_query = "SELECT ctf_flag, ctf_points FROM ctfs WHERE ctf_name = '$ctf'";
$ctf_result = mysqli_query($conn, $ctf_query);
if (mysqli_num_rows($ctf_result) > 0) {
  $ctf_row = mysqli_fetch_assoc($ctf_result);
  $correct_flag = $ctf_row["ctf_flag"];
  $ctf_points = $ctf_row["ctf_points"];
} else {
  // The ctf doesn't exist in the database
  die("Invalid CTF name");
  
}

// Check if the submitted flag is correct
if ($flag == $correct_flag) {
  // Flag is correct, update the ctf_done and users tables

  // Get the user ID from the users table
  $user_query = "SELECT id FROM users WHERE username = '$username'";
  $user_result = mysqli_query($conn, $user_query);
  if (mysqli_num_rows($user_result) > 0) {
    $user_row = mysqli_fetch_assoc($user_result);
    $user_id = $user_row["id"];
  } else {
    // The user doesn't exist in the database
    die("Invalid username");
    
  }

  // Update the ctf_done table
  $ctf_done_query = "INSERT INTO ctf_done (user_id, ctf_name) VALUES ('$user_id', '$ctf')";
  mysqli_query($conn, $ctf_done_query);

  // Update the points in the users table
  $update_query = "UPDATE users SET points = points + $ctf_points WHERE id = '$user_id'";
  mysqli_query($conn, $update_query);

  // Display a success message
  $_SESSION['flag_success'] = true;

// redirect to dashboard or wherever you want to go
   header('Location: dashboard.php');
   exit();
//   sleep(5);
//   echo '<script>window.location.href = "dashboard.php"</script>';

} else {
  // Flag is incorrect
  $_SESSION['flag_success'] = false;

// redirect to dashboard or wherever you want to go
   header('Location: dashboard.php');
   exit();
//   sleep(5);
//   echo '<script>window.location.href = "dashboard.php"</script>';
}

// Close the database connection
mysqli_close($conn);
?>
