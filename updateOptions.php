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
<style>
  body {
    font-family: Lato, Helvetica, sans-serif;
    background: url(oundle.jpg) no-repeat center center fixed;
    background-repeat: no-repeat;
    background-size: 800px 800px;
    height:100%;
  }

  table {
    position: relative;
  }

  #logout {
    position: absolute;
    background: #053162;
    padding: 15px;
    color: #fff;
    font-size: 20px;
    border-radius: 4px;
    top: 10px;
    right:10px;
  }

  .logout {
    background-color: #053162;
    width: 100%;
    height: 60px;
  }
  #view {
    position: absolute;
    top: 80px;
    right: 20px;
    float: right;
  }
  /* Full-width input fields */
  input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
  }

  /* Set a style for all buttons */
  button {
      background-color: #053162;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
  }

  button:hover {
      opacity: 0.8;
  }

  .container {
      padding: 16px;
  }

  span.psw {
      float: right;
      padding-top: 16px;
  }

  /* The Modal (background) */
  .modal {
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      padding-top: 60px;
  }

  #location {
    display:None;
  }

  #date {
    display:None;
  }

  .close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
  }

  .close:hover,
  .close:focus {
    color: #053162;
    cursor: pointer;
  }

  /* Modal Content/Box */
  .modal-content {
      background-color: #fefefe;
      margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
  }

  /* Change styles for span and cancel button on extra small screens */
  @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
  }
</style>
</head>
<body>
  <div class = 'logout'>
    <form method = "post" action = "logout.php">
      <input type = "submit" name = "logout" value = "logout" id = "logout">
    </form>
  </div>
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
    <button onclick="document.getElementById('date').style.display='block'" style="width:auto;">View by date</button>
    <button onclick="document.getElementById('location').style.display='block'" style="width:auto;">View by delivery location</button>
  </div>
</body>
</html>
