<?php
  session_start();
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  try {
    if ($_POST["uname"] == "admin" and $_POST["psw"] == "nimda") {// if user login information correct
      $_SESSION["admin"] = true;
      header("Location: updateOptions.php");
      exit();
    } else {
      $stmt = $conn->prepare("SELECT password FROM pupils WHERE email = :email");
      $stmt->bindParam(':email',$_POST["uname"]);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      echo("<h1>".$_POST["psw"]."</h1>");
      echo("<h1>".$row["password"]."</h1>")
      $attempt = $_POST["psw"];
      $hashed = $row["password"];
      if (password_verify($attempt,$hashed)){
        $_SESSION["email"] = $_POST["uname"];
        header("Location: order.php");
        exit();
      } else {
        ?><script>
          if (window.confirm('Incorrect password, please press ok to try again')){
            window.location.href='index.php?login=false';
          } else {
  					window.location.href='index.php?login=false';
  				};
          </script><?php
          exit();
      }
    }
    $conn=null;
  }
catch(PDOException $e)
  	{
  		echo "error".$e->getMessage();
  	}
?>
