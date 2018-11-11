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
        $stmt = $conn->prepare("SELECT * FROM food WHERE foodType = 0 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["NAME"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")");
          }
        }
      ?>
    </select>
    Drink: <select name = "drink">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE foodType = 1 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["NAME"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")");
          }
        }
      ?>
    </select>
    Snack: <select name = "food">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE foodType = 2 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["NAME"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")");
          }
        }
      ?>
    </select>
    Fruit: <select name = "food">
      <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM food WHERE foodType = 3 and Stock > 0");
        $stmt.execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          echo("<option>".$row["NAME"]."</option>");
          if ($row["Health Advice"] != "None") {
            echo("<script>alert.(This has the following health advice:".$row["Health Advice"]")");
          }
        }
      ?>
    </select>
    <input type="submit" value="New Order">
  </form>
</body>
</html>
