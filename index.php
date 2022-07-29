<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width = device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href=".css/styles.css">
  <script src="login.js"></script>

</head>

<body onload="startTime()">

  <div id="txt"></div>

  <div class="login-main-container">
    <div class="login-container">
      <div class="login-pic-container">
        <img class="login-pic" src=".css/image/utmlogo.png" alt="">
      </div>

      <form id="loginForm" class="login-form" method="post">
        <div class="login-title">College Registration</div>
        <div class="login-desc">Login Page</div><br><br>
        <p><b>Username</b></p>
        <input id="username" class="login-form-text" type="text" name="username" placeholder="Your Username" />
        <p><b>Password</b></p>
        <input id="password" class="login-form-text" type="password" name="password" placeholder="Your Password" /></p>
        <input type="checkbox" name="remember" /> Remember me
        <input id="submit" class="login-btn" type="submit" value="LOGIN" /><br>
      </form>

    </div>

  </div>

</body>

</html>

<script>
  function startTime() {

    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = "Current Time:  " + h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
  }

  function checkTime(i) {
    if (i < 10) {
      i = "0" + i
    }; // add zero in front of numbers <script 10
    return i;
  }

  document.getElementById("submit").addEventListener('click', function(e) {
    e.preventDefault();

    const formdata = new FormData(document.getElementById("loginForm"));
    var xhr = new XMLHttpRequest();


    xhr.open("post", "https://college-registration-system.herokuapp.com/api/login", true);

    xhr.onload = function() {

      if (xhr.readyState === xhr.DONE) {
        if (xhr.responseText.trim() == "2") {
          alert("Login as Accomodation Manager");
          window.location.href = 'https://college-registration-system.herokuapp.com/main.php';

        }
        else if (xhr.responseText.trim() == "3") {
          alert("Login as Student");
          window.location.href = 'https://college-registration-system.herokuapp.com/main.php';

        } else {
          alert("Please enter valid and registered username or password!");
        }
      }

    }
    xhr.send(formdata);

  });
</script>