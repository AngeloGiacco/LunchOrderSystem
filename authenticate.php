<?php
  session_start();
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  try {
    if ($_POST["uname"] == "admin" and $_POST["psw"] == "nimda") {// if user login information correct
      header("Location: updateOptions.php");
      exit();
    } else {
      $stmt = $conn->prepare("SELECT password FROM pupils WHERE email = :email");
      $stmt->bindParam(':email',$_POST["uname"]);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row["password"] == $_POST["psw"]) {
        $_SESSION["email"] = $_POST["uname"];
        header("Location: order.php");
        exit();
      } else {
        if ($row["password"] = $_POST["psw"]) {
          ?><script>
          if (window.confirm('Incorrect password, please press ok to try again')){
            window.location.href='index.php?login=false';
          };
          </script><?php
        }
      }
    }
    $conn=null;
  }
catch(PDOException $e)
  	{
  		echo "error".$e->getMessage();
  	}
?>
