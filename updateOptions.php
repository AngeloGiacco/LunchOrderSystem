<?php
  session_start();
  if (!isset($_SESSION["admin"])) {
    header('Location: index.php?login=false');
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Subjects</title>
<link rel = "stylesheet" type = "text/css" href = "stylesheet.css" />
<style>
  /* Change styles for span and cancel button on extra small screens */
  @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
  }

  table {
    font-weight: bold;
  }
</style>
</head>
<body>
  <form method = "post" action = "logout.php">
    <input type = "submit" name = "logout" value = "logout" id = "logout">
  </form>
  <div id="stock">
    <h1>Current options</h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Status</th>
        <th>Reorder</th>
      </tr>
    <?php
    	include_once('connection.php');
    	$stmt = $conn->prepare("SELECT * FROM food"); //select all the food options from the food table
    	$stmt->execute();
    	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) //print all the options
  		{
        echo("<tr>");
        echo("<td>".$row["Name"]."</td>");
        echo("<td>".$row["Stock"]."</td>");
        echo("<td>".$row["Price"]."</td>");
        if ($row["Stock"] < 100) {
          echo("<td style='color:red'><b><u>Critical</u></b></td>");
        } elseif ($row["Stock"] < 250) {
          echo("<td style='color:orange'><u>Suggested</u></td>");
        } elseif ($row["Stock"] < 500) {
          echo("<td style='color:#DCD610'><b>Not yet necessary</b></td>");
        } else {
          echo("<td style='color:green'>Enough stock</td>");
        }
        $i = $row["FoodID"].",".$row["Stock"];
        echo("<td><form action ='stock.php' method = 'post'><input type = 'number' name = '".$i."' min = '1' required><input type='submit' value = 'submit'></form>");
        echo("</tr>");
      }
      $conn=null;
    ?>
    </table>
  </div>
  <div id = "add-container">
    <h1>Add options</h1>
    <p style="color:grey"><em>Please fill in the fields and submit to add options to the website</em></p>
    <div id="add" class="modal">
      <span onclick="document.getElementById('add').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form id = "addForm"class="modal-content" action="add_option.php" method = "post">
        <div class = "container">
          <h1>Add Option Form</h1>
          <p>Please fill in the information for the food option that you would like to add</p>

          <input type = "text" name = "Name" placeholder="Enter food here" required><br><br>
          Stock: <input type = "number" name = "Stock" min = 0 required><br><br>
          Price: <input type = "number" name = "Price" min = 0 required><br><br>
          Health advice:<input type ="text" name = "advice" placeholder="Please enter the exact health advice, if there isn't any enter None"><br><br>
          Food type:<input type = "radio" name = "FoodType" value = "0" checked>Sandwich
          <input type = "radio" name = "FoodType" value = "1">Drink
          <input type = "radio" name = "FoodType" value = "2">Snack
          <input type = "radio" name = "FoodType" value = "3">Fruit
          <div class="clearfix">
            <button type="button" onclick="document.getElementById('add').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Add Option</button>
          </div>
        </div>
      </form>
    </div>
    <button onclick="document.getElementById('add').style.display='block'" style="width:auto;">Add options</button>
  </div>

  <script>
  // Get the modal
  var modal = document.getElementById('add');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
  </script>

  <div id = "view">
    <h1>View Orders</h1>
    <p style="color:grey"><em>Please select which field you would like to use to view the orders</em></p>

    <div id="date" class="modal">
      <span onclick="document.getElementById('date').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="view.php" method = "post">
        <div class="container">
          <h1>View by Date Required</h1>
          <p>Please select the date that you would like to see all orders for</p>

          <?php
            echo "Date Required:<input type='date' name = 'date' min='".date("Y-m-d")."' required></input>";
          ?>

          <div class="clearfix">
            <button type="button" onclick="document.getElementById('date').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">View Orders</button>
          </div>
        </div>
      </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('date');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    <div id="location" class="modal">
      <span onclick="document.getElementById('location').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="view.php" method = "post">
        <div class="container">
          <h1>View by Delivery Location</h1>
          <p>Please select the location(s) that you would like to see all orders for</p>

          <form action="view.php">
            <input type="checkbox" name="location[]" value="Sports Hall">Sports Hall
            <input type="checkbox" name="location[]" value="Two Acre">Two Acre
            <input type="checkbox" name="location[]" value="Laxton">Laxton
            <input type="checkbox" name="location[]" value="Fisher">Fisher
            <input type="checkbox" name="location[]" value="Crosby">Crosby
            <input type="checkbox" name="location[]" value="Sidney">Sidney
            <input type="checkbox" name="location[]" value="Grafton">Grafton
            <input type="checkbox" name="location[]" value="St. A">St. A
            <input type="checkbox" name="location[]" value="School House">School House
            <input type="checkbox" name="location[]" value="Bramston">Bramston
            <input type="checkbox" name="location[]" value="Laundimer">Laundimer
            <input type="checkbox" name="location[]" value="Kirkeby">Kirkeby
            <input type="checkbox" name="location[]" value="Wyatt">Wyatt
            <input type="checkbox" name="location[]" value="Dryden">Dryden
            <input type="checkbox" name="location[]" value="Sanderson">Sanderson
            <input type="checkbox" name="location[]" value="New House">New House
          </form>

          <div class="clearfix">
            <button type="button" onclick="document.getElementById('location').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">View Orders</button>
          </div>
        </div>
      </form>
    </div>
    <script>
    // Get the modal
    var modal = document.getElementById('location');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    <form action = "view.php" method = "post"><button type = "submit" value = "all" name = "all" style="width:auto;">View all</button></form>
    <button onclick="document.getElementById('date').style.display='block'" style="width:auto;">View by date</button>
    <button onclick="document.getElementById('location').style.display='block'" style="width:auto;">View by delivery location</button>
  </div>
</body>
</html>
