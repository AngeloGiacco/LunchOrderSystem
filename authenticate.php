<?php
  //authenticate the user
  //absolute madness
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try {
  $stmt = $conn.->prepare("SELECT password FROM pupils WHERE email = :email");
  $stmt.bindParam(':email',$_POST["email"]);
  $stmt.execute();
  if ($_POST["email"] = "admin " and $_POST["psw"] = "nimda") {// if user login information correct
    echo "successful admin login";
    header("location: updateOptions.php");
  } else {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row["password"] = $_POST["psw"]) {
      echo "successful login";
      header("location: order.php");
    } else {
      echo "incorrect password";
      header("location:index.html");
    }
  }
}
catch(PDOException $e)
  	{
  		echo "error".$e->getMessage();
  	}
?>
