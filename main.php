<?php
session_start(); // Start up your PHP Session
if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
  header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href=".css/styles.css">
</head>

<body>
  <div class="main-main-container">
    <h2 class="main-title">Main page</h2>
    <div class="main-container">
      <div class="main-item session">
        <div>
          <?php
          if ($_SESSION["LEVEL"] == 2)
            echo '<a href="accomodation_manager/am.php"><img class="main-item-image" src=".css/image/avatar.svg" alt="Avatar"></a>';
          ?>

          <?php
          if ($_SESSION["LEVEL"] == 3)
            echo '<a href="student/student.php"><img class="main-item-image" src=".css/image/avatar.svg" alt="Avatar"></a>';
          ?>
        </div>
        <p class="main-item-title">User menu</p>

      </div>

      <div class="main-item logout">

        <div>
          <a href="logout.php"><img class="main-item-image" src=".css/image/logout.svg" alt="logout"></a>
        </div>
        <p class="main-item-title">Logout</p>

      </div>

    </div>
  </div>

</body>

</html>