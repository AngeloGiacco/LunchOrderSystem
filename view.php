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
      $stmt = $conn->prepare("SELECT * FROM Orders WHERE Location = :location ");
      $stmt->bindParam(':location',$location);
      $stmt->execute();
        while ($order = $stmt->fetch(PDO::FETCH_ASSOC))
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
    }
  }else {
    if (isset($_POST["date"])) {
      //otherwise user must want to do it by date
      //display date
      $stmt = $conn->prepare("SELECT * FROM Orders WHERE DateRequired = :datereq;");
      $stmt->bindParam(':datereq',$_POST["date"]);
      $stmt->execute();
    } else {
      $stmt = $conn->prepare("SELECT * FROM Orders");
      $stmt->execute();
    }
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
    while ($order =  $stmt->fetch(PDO::FETCH_ASSOC))
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
  }
?>
