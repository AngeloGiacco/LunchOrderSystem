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
  <link rel = "stylesheet" type = "text/css" href = "stylesheet.css" />
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
