<!DOCTYPE html>
<html>
<head>
  <title>Order Page</title>
<head>
<body>
  <form action = "new_order.php" method = "post">
    Sandwich:<select name = "sandwich">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 0 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.('This has the following health advice:".$row["Health Advice"]."')</script>");
          }
        }
      ?>
    </select>
    Drink: <select name = "drink">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 1 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.('This has the following health advice:".$row["Health Advice"]."')</script>");
          }
        }
      ?>
    </select>
    Snack: <select name = "food">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 2 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.('This has the following health advice:".$row["Health Advice"]."')</script>");
          }
        }
      ?>
    </select>
    Fruit: <select name = "food">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 3 and Stock > 0");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.('This has the following health advice:".$row["Health Advice"]."')</script>");
          }
        }
      ?>
    </select>
    <?php
      echo "Date Required:<input type='date' min='".date("Y-m-d",strtotime("tomorrow"))."' required></input>";
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
</body>
</html>
