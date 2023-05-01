<!DOCTYPE html>
<html>
<head>
  <title>Goat</title>
  <?php include 'captcha.php'; 
      session_start();

    if ( isset( $_SESSION["registered"]) ){

      if ($_SESSION["registered"]){
        echo "<h2>successful registration!</h2>";
        unset($_SESSION['registered']);
      }
      else{
        echo "<h2>registeration failed!</h2>";
        unset($_SESSION['registered']);
      }

    }
    ?>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
  <div style="text-align: center;">
    <img src='goat.jpg' style="width: 30%; height: auto" >
</div>
    <form action="" method="post">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <div class="g-recaptcha" data-sitekey="6LcIB7AlAAAAAOyzieks4UHOlPOuNOlVtk_DMHug"></div>
      <div class="button-container">
      <button class="button"  type="submit">Login</button>
      <button class="button" id="register-button"  href="register.php">Register</button>
      </div>
    </form>
    <script>
  document.getElementById('register-button').addEventListener('click', function(e) {
    e.preventDefault(); // prevent the default form submission behavior
    window.location.href = "register.php"; // redirect to the desired page
  });
</script>


  </div>

</body>
</html>
