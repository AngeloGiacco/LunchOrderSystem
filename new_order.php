<?php
  session_start();
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
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
  $stmt = $conn->prepare("SELECT StudentID, email FROM pupils");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["email"] == $_SESSION["email"]) {
        $studentID = $row["StudentID"];
        break 1;
    }
  }
  $stmt = $conn->prepare("SELECT * FROM Orders");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["StudentID"] == $studentID and $row["DateRequired"] == $_POST["required"])
    {
      ?><script>
          if (window.confirm('You have already ordered a packed lunch for this day! Please order one for another day!')){
            window.location.href='order.php';
          } else {
  					window.location.href='order.php';
  				};
          </script><?php
      exit();
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
