<?php
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try {
  if ($_POST["uname"] == "admin" and $_POST["psw"] == "nimda") {// if user login information correct
    echo "<h1 style='color:red;background-color: #fefefe'>successful admin login</h1>";
    header("location: updateOptions.php");
  } else {
    $stmt = $conn->prepare("SELECT password FROM pupils WHERE email = :email");
    $stmt->bindParam(':email',$_POST["email"]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($row);
    if ($row["password"] = $_POST["psw"]) {
      echo "<h1 style='color:black;background-color:#fefefe'>successful login</h1>";
      header("location: order.php");
    } else {
      echo "<h1 style='color:red;background-color: #fefefe'>Incorrect password</h1>";
      header("location:index.html");
    }
  }
}
catch(PDOException $e)
  	{
  		echo "error".$e->getMessage();
  	}
?>
