<!DOCTYPE html>
<html>
<head>
<title>Subjects</title>

</head>
<body>
  <h1>Current options</h1>
  <?php
  	include_once('connection.php');
  	$stmt = $conn->prepare("SELECT * FROM food"); //select all the food options from the food table
  	$stmt->execute();
  	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) //print all the options
  		{
  			echo($row["Name"].' costs '.$row["Price"].". There are still ".$row["Stock"]." in stock and the health advice is ".$row["Health Advice"]."<br>");
  		}
    $conn=null;
  ?>
  <h1>Update options</h1>
</body>
</html>
