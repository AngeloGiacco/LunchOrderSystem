<?php
  session_start();
  include_once("connection.php");
  if (isset($_POST["location"])) {
    //if user wants to view by delivery Location
    //show locations
    echo('<table>');
    echo('<tr>');
    echo('<th>StudentID</th>');
    echo('<th>ChoiceSandwich</th>');
    echo('<th>ChoiceDrink</th>');
    echo('<th>ChoiceSnack</th>');
    echo('<th>ChoiceFruit</th>');
    echo('<th>Date Ordered</th>');
    echo('<th>Date Required</th>');
    echo('<th>Location</th>');
    echo('</tr>');
    foreach ($_POST["location"] as $location)
    {
      echo($location);
      $stmt = $conn->prepare("SELECT * FROM 'Orders' WHERE 'Location' = :location ");
      $stmt->bindParam(':location',$location);
      $stmt->execute();
      $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
      echo("<h1>".sizeOf($fetched)."</h1>");
      print_r($fetched);
      /*
      if (sizeOf($fetched) > 0) {
        while ($order = $fetched)
        {
          echo('<tr>');
          echo('<td>'.$order['StudentID'].'</td>');
          echo('<td>'.$order['ChoiceSandwich'].'</td>');
          echo('<td>'.$order['ChoiceDrink'].'</td>');
          echo('<td>'.$order['ChoiceSnack'].'</td>');
          echo('<td>'.$order['ChoiceFruit'].'</td>');
          echo('<td>'.$order['DateOrdered'].'</td>');
          echo('<td>'.$order['DateRequired'].'</td>');
          echo('<td>'.$order['Location'].'</td>');
          echo('</tr>');
        }
        echo('</table>');
      } else {
        echo("<h1>There are no orders required at".$location."</h1>");
      }
      */
    }
  }else{
    //otherwise user must want to do it by date
    //display date
    $stmt = $conn->prepare("SELECT * FROM Orders WHERE DateRequired = :datereq;");
    $stmt->bindParam(':datereq',$_POST["date"]);
    $stmt->execute();
    $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
    echo("<h1>".sizeOf($fetched)."</h1>");
    print_r($fetched);
    /*
    if (sizeOf($fetched) > 0) {
      echo('<table>');
      echo('<tr>');
      echo('<th>StudentID</th>');
      echo('<th>ChoiceSandwich</th>');
      echo('<th>ChoiceDrink</th>');
      echo('<th>ChoiceSnack</th>');
      echo('<th>ChoiceFruit</th>');
      echo('<th>Date Ordered</th>');
      echo('<th>Date Required</th>');
      echo('<th>Location</th>');
      echo('</tr>');
      while ($order = $fetched)
      {
        echo('<tr>');
        echo('<td>'.$order['StudentID'].'</td>');
        echo('<td>'.$order['ChoiceSandwich'].'</td>');
        echo('<td>'.$order['ChoiceDrink'].'</td>');
        echo('<td>'.$order['ChoiceSnack'].'</td>');
        echo('<td>'.$order['ChoiceFruit'].'</td>');
        echo('<td>'.$order['DateOrdered'].'</td>');
        echo('<td>'.$order['DateRequired'].'</td>');
        echo('<td>'.$order['Location'].'</td>');
        echo('</tr>');
      }
      echo('</table>');
    } else {
      echo('<h1>There are no packed lunches for this date'.$_POST["date"].'</h1>');
    }
    */
  }
?>
