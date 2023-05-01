<?php
if (isset($_POST["g-recaptcha-response"])) {
  $secretKey = "6LcIB7AlAAAAAAZLncCunjciyICqvGi6gBbfqK4L";
  $recaptchaResponse = $_POST["g-recaptcha-response"];
  $url = "https://www.google.com/recaptcha/api/siteverify";
  $data = array(
    "secret" => $secretKey,
    "response" => $recaptchaResponse,
  );
  $options = array(
    "http" => array(
        "header" => "Content-type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($data),
    ),
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result);
  //print_r($response);

  if ($response->success) {
    
    include 'db_connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $hashed_password = md5($password);


  // prepare the SQL query
 

  $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND pass_md5=?");
  $stmt->bind_param("ss", $username, $hashed_password);
  $stmt->execute();

// Get the result set
  $result = $stmt->get_result();

  // execute the query
  // $result = mysqli_query($conn, $sql);
//   print_r($result);

  // check if any rows were returned
  if (mysqli_num_rows($result) > 0) {
    // login successful, redirect to the homepage
    session_start();
    // Assume $user_id contains the user's ID after successful login
    
    
    // Set the session variable
    $_SESSION['user_id'] = $username;

    echo '<script>window.location.href = "dashboard.php"</script>';
   //  header('Location: dashboard.php?user='.$username);
    
  } else {
    // login failed, display an error message
    echo 'Invalid username or password';
  }

  // close the database connection
  mysqli_close($conn);
}
    exit;
  } else {
      echo "<h2>Invalid captcha!<h2>";
  }
} 
?>