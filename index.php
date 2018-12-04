<?php
  session_start();
?>
<!DOCTYPE html>
<head>
    <title>Lunch order system</title>
    <link rel = "stylesheet" type = "text/css" href = "stylesheet.css" />
    <style>
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
           display: block;
           float: none;
        }
    }
    </style>
</head>
<body>
  <div id="id01" class="modal">

    <form class="modal-content" action="authenticate.php" method = "post">

      <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>

      <div class="container" style="background-color:#fefefe">
        <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button>
        <span class="psw" style="color:ffffff">Forgot <a href="forgot_password.php">password?</a></span>
      </div>
    </form>
  </div>

  <div id="id02" class="modal">
    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="signUpVerification.php" method = "post">
      <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="surname"><b>Surname</b></label>
        <input type="text" placeholder="Enter Surname" name="surname"  required>

        <label for="forename"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="forename"  required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email"  required>

        <label for="house"><b>House</b></label>
        <input type="text" placeholder="Enter House" name="house"  required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw"  required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat"  required>

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <div class="clearfix">
          <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
  </div>

  <script>
  // Get the modal
  var modal = document.getElementById('id02');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
  </script>
</body>
