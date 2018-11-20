<?php
//connect to the database, add data to the order table, reduce stock in food table
//data required
//  echo date('Y-m-d');
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  //header("location: order.php");
  print_r($_SESSION);
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
  $stmt = $conn->prepare("SELECT * FROM pupils");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["email"] == $_SESSION["email"]) {
      $stmt2 = $conn->prepare("SELECT StudentID FROM pupils WHERE email = :email");
      $stmt2->bindParam(':email', $_POST["email"]);
      $stmt2->execute();
      while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $studentID = $row2;
        break 2;
      }
    }
  }
  echo $studentID;
  $stmt = $conn->prepare("INSERT INTO Orders (StudentID, ChoiceSandwich, ChoiceDrink, ChoiceSnack,ChoiceFruit,DateOrdered,DateRequired,Location) Values (:studentID,:choicesa,:choiced, :choicesn, :choicef,:dateo, :dated, :location)");
  $stmt->bindParam(':studentID', $studentID);
  $stmt->bindParam(':choicesa', $sandwichID);
  $stmt->bindParam(':choiced', $drinkID);
  $stmt->bindParam(':choicef', $fruitID);
  $stmt->bindParam(':choicesn', $snackID);
  $stmt->bindParam(':dateo', date('Y-m-d'));
  $stmt->bindParam(':dated', $_POST["required"]);
  $stmt->bindParam(':location', $_POST["location"]);
  $stmt->execute();
?>

