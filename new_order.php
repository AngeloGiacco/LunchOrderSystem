<?php
  session_start();
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  $stmt = $conn->prepare("SELECT * FROM food");
  $stmt->execute();
  $count = 0;
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $count = $count + 1;
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
  $stmt = $conn->prepare("SELECT StudentID, email FROM pupils");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["email"] == $_SESSION["email"]) {
        $studentID = $row["StudentID"];
        break 1;
    }
  }
  $stmt = $conn->prepare("INSERT INTO Orders (StudentID, ChoiceSandwich, ChoiceDrink, ChoiceSnack,ChoiceFruit,DateOrdered,DateRequired,Location)Values (:studentID,:choicesa,:choiced, :choicesn, :choicef,:dateo, :dated, :location)");
  $stmt->bindParam(':studentID', $studentID);
  $stmt->bindParam(':choicesa', $sandwichID);
  $stmt->bindParam(':choiced', $drinkID);
  $stmt->bindParam(':choicef', $fruitID);
  $stmt->bindParam(':choicesn', $snackID);
  $stmt->bindParam(':dateo', date('Y-m-d'));
  $stmt->bindParam(':dated', $_POST["required"]);
  $stmt->bindParam(':location', $_POST["location"]);
  $stmt->execute();
  $conn=null;
  header('Location: order.php');
  exit();
?>
