

<!DOCTYPE html>
<html>
<head>
  <title>Goat</title>

  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

  
<?php include 'add_user_captcha.php' ?>
  <div class="container">  
  <h1>Register</h1>
  
  <form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <div class="g-recaptcha" data-sitekey="6LcIB7AlAAAAAOyzieks4UHOlPOuNOlVtk_DMHug"></div>

    <button class="button" type="submit">Register</button>
  </div>
  </form>

</body>
</html>
