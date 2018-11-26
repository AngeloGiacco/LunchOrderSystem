<?php
  session_start();
  array_map("htmlspecialchars", $_POST);
  include_once("connection.php");
  foreach ($_POST as $key => $value) {
    break;
  }
  list($foodID,$Stock) = explode(",", $key);
  $order = $value;
  $total  = $order + $Stock;
  $stmt = $conn->prepare("UPDATE food SET Stock = :total WHERE food.FoodID = :FoodID;");
  $stmt->bindParam(':total',$total);
  $stmt->bindParam(':FoodID',$foodID);
  $stmt->execute();
  $conn=null;
  header("Location: updateOptions.php");
  exit();
?>
