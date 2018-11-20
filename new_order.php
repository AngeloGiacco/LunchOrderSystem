<?php
//connect to the database, add data to the order table, reduce stock in food table
//data required
//  echo date('Y-m-d');
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  header("location: order.php");
  //we have the food names, now we need to find the associated ID
  //studentID can be found from email
  //date ordered is today
  //location and date required are posted
  //dates are in the form yyyy-mm-dd
  $stmt = $conn->prepare("SELECT * FROM food");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["Name"] == $_POST["sandwich"]) {
      $sandwichID = $row["FoodID"];
    } elseif ($row["Name"] == $_POST["drink"]) {
      $drinkID = $row["FoodID"];
    } elseif ($row["Name"] == $_POST["snack"]) {
      $snackID = $row["FoodID"];
    } elseif ($row["Name"] == $_POST["fruit"]) {
      $fruitID = $row["FoodID"];
    }
  }
  $stmt = $conn->prepare("INSERT INTO Orders (StudentID, ChoiceSandwich, ChoiceDrink, ChoiceSnack,ChoiceFruit,DateOrdered,DateRequired,Location) Values (2,:choicesa,:choiced, :choicesn, :choicef,:dateo, :dated, :location)");
  $stmt->bindParam(':choicesa', $sandwichID);
  $stmt->bindParam(':choiced', $drinkID);
  $stmt->bindParam(':choicef', $fruitID);
  $stmt->bindParam(':choicesn', $snackID);
  $stmt->bindParam(':dateo', date('Y-m-d'));
  $stmt->bindParam(':dated', date("Y-m-d",strtotime("tomorrow")));
  $stmt->bindParam(':location', $_POST["location"]);
  $stmt->execute();
?>
