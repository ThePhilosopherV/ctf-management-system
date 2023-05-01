<?php

if (isset($_SESSION['flag_success'])){
    if ( $_SESSION['flag_success']) {
      echo '<script>
      
      var overview = document.getElementById("overview-tab");
      overview.classList.remove("active");
      var challenges = document.getElementById("challenges-tab");
      challenges.classList.add("active");


      const over = document.getElementById("overview");
      over.classList.remove("show");
      over.classList.remove("active");

      const ch = document.getElementById("challenges");
      ch.classList.add("show");
      ch.classList.add("active");

      </script>';

      echo '<div id ="message" class="well-done">Well done!</div>';
      unset($_SESSION['flag_success']); // remove flag so message doesn't show again
  }
  else {
    echo '<script>
      
      var overview = document.getElementById("overview-tab");
      overview.classList.remove("active");
      var challenges = document.getElementById("challenges-tab");
      challenges.classList.add("active");


      const over = document.getElementById("overview");
      over.classList.remove("show");
      over.classList.remove("active");

      const ch = document.getElementById("challenges");
      ch.classList.add("show");
      ch.classList.add("active");

      </script>';
    echo '<br><div id ="message" class="incorrect">Incorrect</div>';
      unset($_SESSION['flag_success']); // remove flag so message doesn't show again
  }
  }

?>