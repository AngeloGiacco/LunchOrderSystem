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
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")</script>");
          }
        }
      ?>
    </select>
    Drink: <select name = "drink">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 1 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")</script>");
          }
        }
      ?>
    </select>
    Snack: <select name = "food">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 2 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")</script>");
          }
        }
      ?>
    </select>
    Fruit: <select name = "food">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 3 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["Name"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")</script>");
          }
        }
      ?>
    </select>
    <input type="submit" value="New Order">
  </form>
</body>
</html>
