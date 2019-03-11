<?php
  session_start();
  include_once("connection.php");
  if (isset($_POST["location"])) {
    //if user wants to view by delivery Location
    //show locations
    echo('<table>');
    echo('<tr>');
    echo('<th>Student</th>');
    echo('<th>ChoiceSandwich</th>');
    echo('<th>ChoiceDrink</th>');
    echo('<th>ChoiceSnack</th>');
    echo('<th>ChoiceFruit</th>');
    echo('<th>Date Ordered</th>');
    echo('<th>Date Required</th>');
    echo('<th>Location</th>');
    echo('</tr>');
    foreach ($_POST["location"] as $location)
    {
      $stmt = $conn->prepare("SELECT Location, DateOrdered, DateRequired, pupils.Surname, pupils.Forename, Sandwich.Name as sd, Drink.Name as dk, Snack.Name as sk, Fruit.Name as ft FROM `Orders` INNER JOIN pupils ON Orders.StudentID = pupils.StudentID INNER JOIN food as Sandwich ON Sandwich.FoodID = Orders.ChoiceSandwich INNER JOIN food as Drink ON Drink.FoodID = Orders.ChoiceDrink INNER JOIN food as Snack ON Snack.FoodID = Orders.ChoiceSnack INNER JOIN food as Fruit on Fruit.FoodID = Orders.ChoiceFruit WHERE Location = :location");
      $stmt->bindParam(':location',$location);
      $stmt->execute();
      while ($order = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        echo('<tr>');
        echo("<td>".$order["Forename"]." ".$order["Surname"]."</td>");
        echo("<td>".$order['sd']."</td>");
        echo("<td>".$order['dk']."</td>");
        echo("<td>".$order['sk']."</td>");
        echo("<td>".$order['ft']."</td>");
        echo('<td>'.$order['DateOrdered'].'</td>');
        echo('<td>'.$order['DateRequired'].'</td>');
        echo('<td>'.$order['Location'].'</td>');
        echo('</tr>');
      }
    }
  } else {
    if (isset($_POST["date"])) {
      //otherwise user must want to do it by date
      //display date
      $stmt = $conn->prepare("SELECT Location, DateOrdered, DateRequired, pupils.Surname, pupils.Forename, Sandwich.Name as sd, Drink.Name as dk, Snack.Name as sk, Fruit.Name as ft FROM `Orders` INNER JOIN pupils ON Orders.StudentID = pupils.StudentID INNER JOIN food as Sandwich ON Sandwich.FoodID = Orders.ChoiceSandwich INNER JOIN food as Drink ON Drink.FoodID = Orders.ChoiceDrink INNER JOIN food as Snack ON Snack.FoodID = Orders.ChoiceSnack INNER JOIN food as Fruit on Fruit.FoodID = Orders.ChoiceFruit WHERE DateRequired = :datereq");
      $stmt->bindParam(':datereq',$_POST["date"]);
      $stmt->execute();
    } else {
      $stmt = $conn->prepare("SELECT Location, DateOrdered, DateRequired, pupils.Surname, pupils.Forename, Sandwich.Name as sd, Drink.Name as dk, Snack.Name as sk, Fruit.Name as ft FROM `Orders` INNER JOIN pupils ON Orders.StudentID = pupils.StudentID INNER JOIN food as Sandwich ON Sandwich.FoodID = Orders.ChoiceSandwich INNER JOIN food as Drink ON Drink.FoodID = Orders.ChoiceDrink INNER JOIN food as Snack ON Snack.FoodID = Orders.ChoiceSnack INNER JOIN food as Fruit on Fruit.FoodID = Orders.ChoiceFruit");
      $stmt->execute();
    }
    echo('<table>');
    echo('<tr>');
    echo('<th>StudentID</th>');
    echo('<th>ChoiceSandwich</th>');
    echo('<th>ChoiceDrink</th>');
    echo('<th>ChoiceSnack</th>');
    echo('<th>ChoiceFruit</th>');
    echo('<th>Date Ordered</th>');
    echo('<th>Date Required</th>');
    echo('<th>Location</th>');
    echo('</tr>');
    while ($order = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      echo('<tr>');
      echo("<td>".$order["Forename"]." ".$order["Surname"]."</td>");
      echo("<td>".$order['sd']."</td>");
      echo("<td>".$order['dk']."</td>");
      echo("<td>".$order['sk']."</td>");
      echo("<td>".$order['ft']."</td>");
      echo('<td>'.$order['DateOrdered'].'</td>');
      echo('<td>'.$order['DateRequired'].'</td>');
      echo('<td>'.$order['Location'].'</td>');
      echo('</tr>');
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>View</title>
  <link rel = "stylesheet" type = "text/css" href = "stylesheet.css" />

  <style>
  table {
    font-size: 20px;
    font-weight: bold;
  }
  </style>
</head>
<body>
</body>
</html>
