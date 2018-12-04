<?php
//potentially add the user to the database without any information,
//update the info in add_user.php so that they are properly added following validation of the password link
//get the values to update with as well as the id to update through a get function
//means that we would have to add the blank info in this script as well as looking up the StudentID assigned
//and add all the real info and the studentID to the url so that the get function can Work
//token would still be necessary
if ((isset($_POST["email"]))&&(isset($_POST["surname"]))&&(isset($_POST["forename"]))&&(isset($_POST["house"]))&&(isset($_POST["psw"]))&&(isset($_POST["psw-repeat"]))) {
  if ($_POST["psw"] == $_POST["psw-repeat"]) {
    include_once("connection.php");
    $str = "0123456789qwertzuiopasdfghjklyxcvbnm";
    $str = str_shuffle($str);
    $str = substr($str, 0, 10);
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $forname = $_POST["forename"];
    $house = $_POST["house"];
    $url = "www.packedlunch.dx.am/add_user.php?token=$str&surname=$surname&forename=$forname&house=$house&email=$email";
    mail($email, "Verify sign up to packedlunch.dx.am", "To confirm your account please visit: $url", "From: packedlunch@packedlunch.dx.am\r\n");
    $stmt = $conn->prepare("INSERT INTO pupils (StudentID,Surname,Forename,House,email,password,token) VALUES (null,' ',' ',' ',' ',:password,:token)");
    $stmt->bindParam(':password',password_hash($_POST["psw"]),PASSWORD_BCRYPT);
    $stmt->bindParam(':token',$str);
    $stmt->execute();
  } else {
    ?><script>
    if (window.confirm('Passwords did not match. Please try again')){
      window.location.href='index.php';
    } else {
      window.location.href='index.php';
    };
    </script><?php
  }
} else {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
  <link rel = "stylesheet" type = "text/css" href = "success.css" />
</head>
<body>
	<div class="screen un">
        <h2>Email Sent!</h2>
        </>
        <?php echo("<p>An email has been sent to ".$_POST['email']."</p>");?>
        <a href ="order.php"><button id="btnClick">Order a Packed Lunch</button></a>
        <span style="font-family: Arial Unicode MS, Lucida Grande; width = 100px;">&#x2705;</span>
        </div>


        <a href = "index.php"><button type="button" class="btn-overlay restart tr">Home</button></a>
</body>
</html>
