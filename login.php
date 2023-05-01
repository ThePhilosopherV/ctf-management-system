<?php

include 'db_connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $hashed_password = md5($password);


  // prepare the SQL query
  $sql = "SELECT * FROM users WHERE username='$username' AND pass_md5='$hashed_password'";

  // execute the query
  $result = mysqli_query($conn, $sql);
  print_r($result);

  // check if any rows were returned
  if (mysqli_num_rows($result) > 0) {
    // login successful, redirect to the homepage
    echo "you're in";
   //  header('Location: dashboard.php?user='.$username);
    
  } else {
    // login failed, display an error message
    echo 'Invalid username or password';
  }

  // close the database connection
  mysqli_close($conn);
}
?>
