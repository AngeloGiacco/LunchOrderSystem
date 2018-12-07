<?php
  if (isset($_GET["token"]) && isset($_GET["email"])){
    include_once("connection.php");
    $email = $_GET["email"];
    $token = $_GET["token"];
    $stmt= $conn->prepare("SELECT StudentID FROM pupils WHERE email = :email and token = :token");
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':token',$token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (isset($result["StudentID"])){
      $str = "0123456789qwertzuiopasdfghjklyxcvbnm";
      $str = str_shuffle($str);
      $str = substr($str, 0, 15);
      $stmt= $conn->prepare("UPDATE pupils SET password = :str WHERE StudentID = :id");
      $stmt->bindParam(':str',password_hash($str,PASSWORD_BCRYPT));
      $stmt->bindParam(':id',$result["StudentID"]);
      $stmt->execute();
    } else {
      ?><script>
        if (window.confirm('An issue was encountered, please check your links!')){
          window.location.href='index.php';
        } else {
					window.location.href='index.php';
				};
      </script><?php
    }
  } else {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
  <link rel = "stylesheet" type = "text/css" href = "success.css" />
  <style>

  #change{
    display:none;
  }

  * {box-sizing: border-box}
/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 35px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
    width: 100%;
  }
}

  </style>
</head>
<body>
	<div class="screen un">
        <h2>Password Reset</h2>
        </>
        <?php echo("<p>Your password has been set to ".$str.". We recommend you change it to something more memorable</p>");?>
        <a href ="order.php"><button id="btnClick">Order a Packed Lunch</button></a>
        <span style="font-family: Arial Unicode MS, Lucida Grande; width = 100px;">&#x2705;</span>
        </div>
        <div id="change" class="modal">
          <span onclick="document.getElementById('change').style.display='none'" class="close" title="Close Modal">&times;</span>
          <form class="modal-content" action="changePassword.php" method = "post">
            <div class="container">
              <h1>Change Password</h1>
              <p>Please fill in this form to change your password</p>
              <hr>

              <label for="psw"><b>Current Password</b></label>
              <input type="password" placeholder="Enter Current Password" name="psw"  required>

              <label for="new-psw"><b>Password</b></label>
              <input type="password" placeholder="Enter New Password" name="new-psw"  required>

              <label for="new-psw-repeat"><b>Repeat Password</b></label>
              <input type="password" placeholder="Repeat New Password" name="new-psw-repeat"  required>

              <div class="clearfix">
                <button type="button" onclick="document.getElementById('change').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn">Change Password</button>
              </div>
            </div>
          </form>
        </div>

        <script>
        // Get the modal
        var modal = document.getElementById('change');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
        <button onclick="document.getElementById('change').style.display='block'" style="width:auto;" class="btn-overlay restart tr">Change Password</button>
        <a href = "index.php"><button type="button" id="restart" class="btn-overlay home tr">Home</button></a>

</body>
</html>
