<?php
  session_start();
  if (!isset($_SESSION["email"])) {
    header('Location: index.php?login=false');
  }
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  $sandwich = $_POST["sandwich"];
  $drink = $_POST["drink"];
  $snack = $_POST["snack"];
  $fruit = $_POST["fruit"];
  $stmt = $conn->prepare("SELECT * FROM food");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    if ($row["Name"] == $sandwich) {
      $sandwichID = $row["FoodID"];
    } elseif ($row["Name"] == $drink) {
      $drinkID = $row["FoodID"];
    } elseif ($row["Name"] == $snack) {
      $snackID = $row["FoodID"];
    } elseif ($row["Name"] == $fruit) {
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

  //reduce stock
  $var = array($sandwichID, $drinkID, $snackID, $fruitID);
  foreach ($var as $food) {
    $stmt = $conn->prepare("SELECT Stock FROM food WHERE FoodID = :id");
    $stmt->bindParam(":id", $food);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stock = $result["Stock"];
    $newStock = $stock-1;
    $stmt = $conn->prepare("UPDATE food SET Stock = :newStock WHERE food.FoodID = :id");
    $stmt->bindParam(":newStock",$newStock);
    $stmt->bindParam(":id", $food);
    $stmt->execute();
  }
  $datereq = $_POST['required'];
  $url = "www.packedlunch.dx.am/delete_order.php?StudentID=$studentID&datereq=$datereq";
  $email = $_SESSION['email'];
  mail($email, "Packed lunch order", "You have just made the following order at pakedlunch.dx.am: sandwich = $sandwich, drink = $drink, snack = $snack and fruit = $fruit. If this is not correct or someone else placed the order, please cancel the order by visiting this link: $url", "From: packedlunch@packedlunch.dx.am\r\n");
  $conn=null;
  header('Location: order.php');
  exit();
?>
