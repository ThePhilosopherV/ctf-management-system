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
      

      $stmt = $conn->prepare("INSERT INTO users (username, pass_md5) VALUES (?, ?)");
      $stmt->bind_param("ss", $username, $hashed_password);
      

// Get the result set
  
      session_start();  
      if ($stmt->execute()) {
          // User has been registered successfully
          

          $_SESSION["registered"] = true;
          header('Location: index.php');
          exit;
          //echo '<script>window.location.href = "index.php"</script>';
          
          
      } else {
        $_SESSION["registered"] = false;
          header('Location: index.php');
          exit;
      }
      }
      
      
      // Close the database connection
      $conn->close();
        
      
    } else {
        echo "<h2>Invalid captcha!</h2>";
        
    }
  } 

?>