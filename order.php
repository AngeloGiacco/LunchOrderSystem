<?php
  session_start();
  if (!isset($_SESSION["email"])) {
    header('Location: index.php?login=false');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Order Page</title>
  <style>
  body {
    height : 100%;
    font-family: Arial, Helvetica, sans-serif;
    background: url(oundle.jpg) no-repeat center center fixed;
    background-repeat: no-repeat;
    background-size: 800px 800px;
  }

  .warning {
    color: #fff;
    background-color: red;
  }

  #logout {
    background: #b61111;
    padding: 15px;
    color: #fff;
    font-size: 20px;
    border: 0;
    border-radius: 4px;
    box-shadow: 1px 3px 5px rgba(0,0,0,0.5)
  }
  </style>
<head>
<body>
  <form action = "new_order.php" method = "post">
    Sandwich:<select class = "s" name = "sandwich">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 0 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          if ($row["Health Advice"] != "None") {
            echo("<option style='color:red'>".$row["Name"]."</option>");
            echo("<script>alert('".$row['Name']." has the following health advice:".$row['Health Advice']."')</script>");
          } else {
            echo("<option>".$row["Name"]."</option>");
          }
        }

      ?>
    </select>
    Drink: <select class = "s" name = "drink">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 1 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          if ($row["Health Advice"] != "None") {
            echo("<option style='color:red'>".$row["Name"]."</option>");
            echo("<script>alert('".$row['Name']." has the following health advice:".$row['Health Advice']."')</script>");
          } else {
            echo("<option>".$row["Name"]."</option>");
          }
        }

      ?>
    </select>
    Snack: <select class = "s" name = "snack">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 2 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          if ($row["Health Advice"] != "None") {
            echo("<option style='color:red'>".$row["Name"]."</option>");
            echo("<script>alert('".$row['Name']." has the following health advice:".$row['Health Advice']."')</script>");
          } else {
            echo("<option>".$row["Name"]."</option>");
          }
        }

      ?>
    </select>
    Fruit: <select class = "s" name = "fruit">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 3 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          if ($row["Health Advice"] != "None") {
            echo("<option class='warning'>".$row["Name"]."</option>");
            echo("<script>alert('".$row['Name']." has the following health advice:".$row['Health Advice']."')</script>");
          } else {
            echo("<option>".$row["Name"]."</option>");
          }
        }
        $conn=null;
      ?>
    </select><br>
    <?php
      echo "Date Required:<input type='date' name = 'required' min='".date("Y-m-d",strtotime("tomorrow"))."' required></input>";
    ?>
    Location: <select name = "location">
        <option>Sports Hall</option>
        <option>Two Acre</option>
        <option>Laxton</option>
        <option>Fisher</option>
        <option>Crosby</option>
        <option>Sidney</option>
        <option>Grafton</option>
        <option>St. A</option>
        <option>School House</option>
        <option>Bramston</option>
        <option>Laundimer</option>
        <option>Kirkeby</option>
        <option>Wyatt</option>
        <option>Dryden</option>
        <option>Sanderson</option>
        <option>New House</option>
    </select>
    <input type="submit" value="New Order">
  </form>
  <form method = "post" action = "logout.php">
    <input type = "submit" name = "logout" value = "logout" id = "logout">
  </form>
</body>
</html>
