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
  <link rel = "stylesheet" type = "text/css" href = "stylesheet.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class = "top">
    <button id = "changeButton" onclick="document.getElementById('change').style.display='block'" style="width:auto;">Change Password</button>
    <form method = "post" action = "logout.php">
      <input type = "submit" name = "logout" value = "logout" id = "logout">
    </form>
  </div><br><br><br><br>
  <div class = "form">
    <form action = "new_order.php"  id = "orderform" method = "post">
      <div class="form-row align-items-center">
        <div class="col-auto my-1 s">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Sandwich</label>
          <select name="sandwich" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <?php
              include_once("connection.php");
              $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 0 and Stock > 0");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                if ($row["HealthAdvice"] != "None") {
                  echo("<option value = '".$row['Name']."' style='color:red'>".$row["Name"]."*</option>");
                  echo("<script>alert('".$row['Name']." has the following health advice:".$row['HealthAdvice']."')</script>");
                } else {
                  echo("<option>".$row["Name"]."</option>");
                }
              }

            ?>
          </select>
        </div>
        <div class="col-auto my-1 s">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Drink</label>
          <select name = "drink" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <?php
              include_once("connection.php");
              $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 1 and Stock > 0");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                if ($row["HealthAdvice"] != "None") {
                  echo("<option value = '".$row['Name']."' style='color:red'>".$row["Name"]."*</option>");
                  echo("<script>alert('".$row['Name']." has the following health advice:".$row['HealthAdvice']."')</script>");
                } else {
                  echo("<option>".$row["Name"]."</option>");
                }
              }

            ?>
          </select>
        </div>
        <div class="col-auto my-1 s">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Snack</label>
          <select name = "snack" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <?php
              include_once("connection.php");
              $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 2 and Stock > 0");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                if ($row["HealthAdvice"] != "None") {
                  echo("<option value = '".$row['Name']."' style='color:red'>".$row["Name"]."*</option>");
                  echo("<script>alert('".$row['Name']." has the following health advice:".$row['HealthAdvice']."')</script>");
                } else {
                  echo("<option>".$row["Name"]."</option>");
                }
              }

            ?>
          </select>
        </div>
        <div class="col-auto my-1 s">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Fruit</label>
          <select name = "fruit" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
            <?php
              include_once("connection.php");
              $stmt = $conn->prepare("SELECT * FROM food WHERE FoodType = 3 and Stock > 0");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                if ($row["HealthAdvice"] != "None") {
                  echo("<option value = '".$row['Name']."' style='color:red'>".$row["Name"]."*</option>");
                  echo("<script>alert('".$row['Name']." has the following health advice:".$row['HealthAdvice']."')</script>");
                } else {
                  echo("<option>".$row["Name"]."</option>");
                }
              }

            ?>
          </select>
        </div>
    </div>
  </div><br><br>
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
      <div class="col-auto my-1">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    <div id="change" class="modal">
      <span onclick="document.getElementById('change').style.display='none'" class="close" title="Close Modal">&times;</span>
      <form class="modal-content" action="changePassword.php" method = "post">
        <div class="container">
          <h1>Change Password</h1>
          <p>Please fill in this form to change your password</p>
          <hr>

          <label for="psw"><b>Current Password</b></label>
          <input type="password" placeholder="Enter Current Password" name="psw"  required>

          <label for="new-psw"><b>Password</b></label>
          <input type="password" placeholder="Enter New Password" name="new-psw"  required>

          <label for="new-psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat New Password" name="new-psw-repeat"  required>

          <div class="clearfix">
            <button type="button" onclick="document.getElementById('change').style.display='none'" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Change Password</button>
          </div>
        </div>
      </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('change');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
  </div>
  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
