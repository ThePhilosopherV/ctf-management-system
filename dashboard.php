<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  // Redirect the user to the login page
  header('Location: index.php');
  exit;
}
include 'db_connect.php';
$username = $_SESSION['user_id'];
// Replace with the user ID you want to count CTFs for
$sql = "SELECT id FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$user_id = $row['id'];

$sql = "SELECT `rank` FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$rank = $row['rank'];

$sql = "SELECT ctf_name, ctf_points,url FROM ctfs";
$ctfsresult = mysqli_query($conn, $sql);


$sql = "SELECT points FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$points = $row['points'];

$sql = "SELECT ctf_name FROM ctf_done WHERE user_id = '$user_id'";
$ctfs = mysqli_query($conn, $sql);

$sql = "SELECT username, points, FIND_IN_SET(points, (SELECT GROUP_CONCAT(points ORDER BY points DESC) FROM users)) AS `rank` FROM users ORDER BY points DESC";
$rankings = mysqli_query($conn, $sql);


// Build the SQL query
$sql = "SELECT COUNT(*) FROM ctf_done WHERE user_id = $user_id";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}

// Retrieve the result
$count = mysqli_fetch_array($result)[0];

// Close the database connection

?>


<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="dashcss.css">
  <script src="jquery-3.6.4.min.js"></script>
</head>
<body>
<script src="nav.js" ></script>
  <div class="container">
  
    <?php echo "<h1>Welcome, ".$_SESSION['user_id']."</h1>" ?>
    <hr>

    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab"  href="#Overview" id="overview-tab" >Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Challenges" id="challenges-tab" >Challenges</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#Rankings" id="rankings-tab"  >Rankings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="logout.php" >Logout</a>
      </li>
    </ul>

    <div class="tab-content">
      <div id="overview"  class="tab-pane fade show active" >
        <!-- <h2>Overview</h2> -->
        <br>
        <p>Number of completed CTF challenges: <?php echo $count ?></p>
        <p>Overall CTF ranking: <?php echo $rank ?></p>
        <p>Player's points earned: <?php echo $points ?></p>
        <hr>
        <h3>Recent Activity</h3>
        <ul>
        <?php
        $rows= array_reverse(mysqli_fetch_all($ctfs, MYSQLI_ASSOC));
        foreach ($rows as $row) {
          
          echo "<li>". $row['ctf_name'] . "</li>";
        }
          
        ?>
          
        </ul>
      </div>
      

      <div id="challenges"  class="tab-pane fade">
      <br>
        
        <table class="table">
          <thead>
            <tr>
              <th>Challenge</th>
              <th>Points</th>
              <th>Download</th>
              <th>Submit flag</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            
              <?php
              include 'displayflag_message.php';
              
            while ($row = mysqli_fetch_assoc($ctfsresult)) {
    echo "<tr><td>" . $row["ctf_name"] . "</td><td>" . $row["ctf_points"] . "</td><td> <a href='".$row["url"]."' download='".basename($row["url"])."'>Download</a>
    </td><td> <form action='manage_flag.php' method='post'>
    <input type='hidden' value='". $row["ctf_name"] ."' name='ctf'>
    <input type='password' id='flag' name='flag' required>
    
    <button class='button' type='submit'>Submit</button>
  </form>";
    
  $ctf_name = $row['ctf_name'];
    $sql = "SELECT * FROM ctf_done WHERE user_id = $user_id AND ctf_name = '$ctf_name' ";
    $result = mysqli_query($conn, $sql);          

    if(mysqli_num_rows($result) > 0) {
      // user has completed the CTF
      echo "</td><td><span class='checkmark'>&#10003;</span> </td></tr>";
  } else {
    echo "</td><td><span class='opposite-checkmark'>&cross;</span> </td></tr>" ;
      
  }
     
}
mysqli_close($conn);
?>
           <script>
setTimeout(function() {
  var message = document.getElementById('message');
  if (message) {
    message.remove();
  }
}, 3000); // 5000 milliseconds = 5 seconds
</script>

        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>

  <div id="rankings"  class="tab-pane fade">
    <!-- <h2>Rankings</h2> -->
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Player Name</th>
          <th>Points</th>
        </tr>
      </thead>
      <tbody>
        
          <?php
        while ($row = mysqli_fetch_assoc($rankings)) {
    echo "<tr><td>" . $row["rank"] . "</td><td>" . $row["username"] . "</td><td>" . $row["points"] . "</td></tr>";
      }
          ?>
         
        <!-- Add more rows as needed -->
      </tbody>
    </table>
  </div>

</div>

</body>
</html>