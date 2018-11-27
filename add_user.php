<?php
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try{
	$stmt = $conn->prepare("SELECT * FROM pupils");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		if ($row["email"] == $_POST["email"]) {
			?><script>
        if (window.confirm('Unfortunately there is already an accout associated with this email. Please try again with another one by pressing ok or contact the system administrator.')){
          window.location.href='index.php';
        } else {
					window.location.href='index.php';
				};
      </script><?php
			exit();
		}
	}
	$stmt = $conn->prepare("INSERT INTO pupils (StudentID,Surname,Forename,House,email,password)VALUES (null,:surname,:forename,:house,:email,:password)");
	$stmt->bindParam(':forename', $_POST["forename"]);
	$stmt->bindParam(':surname', $_POST["surname"]);
	$stmt->bindParam(':house', $_POST["house"]);
	$stmt->bindParam(':email', $_POST["email"]);
	$stmt->bindParam(':password', $_POST["psw"]);
	$stmt->execute();
	$conn=null;
	header('Location: index.php');
	exit();
}
catch(PDOException $e){
		echo "error".$e->getMessage();
	}
?>
