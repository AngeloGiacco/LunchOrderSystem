<?php
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try{
  $stmt = $conn->prepare("SELECT * FROM food");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if (strtolower($row["Name"]) == strtolower($_POST["Name"])) {
      ?><script>
        if (window.confirm('This food is already an option, please increase the stock instead!')){
          window.location.href='updateOptions.php';
        } else {
          window.location.href='updateOptions.php';        
        };
        </script><?php
      exit();
    }
  }
  $stmt = $conn->prepare("INSERT INTO food (FoodID,Name,Price,Stock,HealthAdvice,FoodType) VALUES (null,:name,:price,:stock,:health,:foodtype)");
  $stmt->bindParam(':name', $_POST["Name"]);
  $stmt->bindParam(':price', $_POST["Price"]);
  $stmt->bindParam(':stock', $_POST["Stock"]);
  $stmt->bindParam(':health', $_POST["advice"]);
  $stmt->bindParam(':foodtype', $_POST["FoodType"]);
  $stmt->execute();
  $conn=null;
  header("Location: updateOptions.php");
  exit();
}
catch(PDOException $e)
	{
  	echo "error".$e->getMessage();
  }
?>
