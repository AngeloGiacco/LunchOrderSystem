<?php
  if (isset($_POST["email"])) {
    include_once("connection.php");
    $email = $_POST["email"];
    $stmt = $conn->prepare('SELECT StudentID FROM pupils WHERE email = :email');
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($result);
    if (isset($result["StudentID"])) {
      $str = "0123456789qwertzuiopasdfghjklyxcvbnm";
      $str = str_shuffle($str);
      $str = substr($str, 0, 10);
      $url = "packedlunch.dx.am/resetPassword.php?token=$str&email=$email";
      mail($email, "Reset Password", "To reset your password please visit this: $url", "From: packedlunch@packedlunch.dx.am\r\n");
      $stmt = $conn->prepare('UPDATE pupils SET token = :str WHERE email = :email');
      $stmt->bindParam(':email',$email);
      $stmt->bindParam(':str',$str);
      $stmt->execute();
    } else {
      ?><script>
      if (window.confirm('Unfortunately there is not an account associated with this email. Please try again with another one by pressing ok or contact the system administrator.')){
        window.location.href='forgot_password.php';
      } else {
        window.location.href='forgot_password.php';
      };
      </script><?php
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="forgot-password.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

body {font-family: Arial, Helvetica, sans-serif;}

#highlighted {
    position: relative;
    background-color: #053162;
}
@media (min-width: 992px)
#highlighted .container-fluid {
    margin-bottom: 2.5rem;
}
#highlighted .container-fluid h1, #highlighted .container-fluid p {
    color: #ffffff;
}
.h1, h1 {
    font-size: 54.93px;
}
.h1, h1, h2, h3, h4, h5, h6 {
    color: #ffffff;
}
.h1, body, h1, h2, h3, h4, h5, h6, html {
    font-weight: 300;
}
#content {
    background-position: right bottom;
    background-repeat: no-repeat;
}
.interior-page {
    background-color: #FFF;
    padding-bottom: 30px;
}
#highlighted+#content.interior-page .interior-page-nav {
    margin-top: -4em;
}
#highlighted+#content.interior-page .interior-page-nav, .interior-page .interior-page-nav {
    padding-left: 0;
}
.sidebar {
    margin-top: 2em;
}
@media (min-width: 1200px)
.col-lg-2 {
    width: 16.66666667%;
}
.content-area-right {
    max-width: 1200px;
    padding-right: 15px;
    padding-left: 15px;
}
.container-fluid>.row h2.crumb-title {
    margin-bottom: 0;
}
.page-title {
    min-height: 50px;
}
.page-title, ul {
    margin: 0;
    list-style: none;
}
.content-crumb-div {
    margin: 5px 0 20px;
}
a {
    text-decoration: none;
}
.container-fluid .row .modal, .page .modal {
    position: fixed;
    top: 35%;
}
#highlighted+#content.interior-page .interior-page-nav, .interior-page .interior-page-nav {
    padding-left: 0;
}
#highlighted+#content.interior-page .interior-page-nav {
    margin-top: -4em;
}
.dynamicDiv.panel-group {
    border: 1px solid #053162;
    margin-left: 30px;
}
.panel-group {
    margin-bottom: 0;
    background-color: #fff;
}
.panel-group .panel {
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    border: none;
    box-shadow: none;
}
.panel-group .panel-heading {
    padding: 0;
    border: none;
}
.panel-default>.panel-heading {
    color: #333;
    background-color: #ffffff;
    border-color: #ddd;
}
.panel-group .panel-heading .panel-title {
    font-size: 1.1em;
    font-family: Verlag,museo-sans,'Helvetica Neue',Helvetica,Arial,sans-serif;
}
.interior-page-nav .panel-group .panel-heading .panel-title a {
    background: 0 0;
}
.panel-group .panel-heading .panel-title a {
    display: block;
    padding: 15px 45px 15px 15px;
    background: url(/resources/images/misc/icon_accordion-open.png) 95% center no-repeat #f6f6f6;
}
span.subMenuHighlight, ul.panel-heading li.panel-title a:hover {
    color: #053162;
}
.panel-group .panel-heading .panel-title {
    font-size: 1.1em;
    font-family: Verlag,museo-sans,'Helvetica Neue',Helvetica,Arial,sans-serif;
}
ul.panel-heading {
    margin-bottom: 1px;
}
.panel-group .panel-heading .panel-title a {
    display: block;
    padding: 15px 45px 15px 15px;
    background: url(/resources/images/misc/icon_accordion-open.png) 95% center no-repeat #f6f6f6;
}
.panel-group {
    margin-bottom: 0;
    background-color: #fff;
}
.label-default {
    background-color: #FFF;
    margin-top: 10px;
}
label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: 700;
}
.form-control {
    border-radius: 0;
}
.btn-primary {
    color: #fff;
    background-color: #053162;
    width: 100%;
}
.btn-block {
    display: block;
}
.btn {
    padding: 8px 28px;
    font-weight: 400;
    -webkit-transition: background .3s ease-in;
    transition: background .3s ease-in;
    white-space: normal;
    border-width: 0 0 1px;
}
.content-area-right {
   margin-top: 10px;
}
</style>
</head>

<body>
  <div id="highlighted" class="hl-basic hidden-xs">
     <div class="container-fluid">
        <div class="row">
           <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">
              <h1>
                 Forgot Password
              </h1>
           </div>
        </div>
     </div>
  </div>

  <div id="content" class="interior-page">
  <div class="container-fluid">
  <div class="row">
  <!--Sidebar-->
  <div class="col-sm-3 col-md-3 col-lg-2 sidebar equal-height interior-page-nav hidden-xs">
     <div class="dynamicDiv panel-group" id="dd.0.1.0">
        <div id="subMenu" class="panel panel-default">
           <ul class="subMenuHighlight panel-heading">
           </ul>
           <ul class="panel-heading">
              <li class="panel-title">
                 <a class="subMenu1" href=""><span class="subMenuHighlight">Forgot Password</span></a>
              </li>
           </ul>
           <ul class="panel-heading">
              <li class="panel-title">
                 <a class="subMenu1" href="index.php"><span>Login</span></a>
              </li>
           </ul>
        </div>
     </div>
  </div>

  <!--Content-->
  <div class="col-sm-9 col-md-9 col-lg-10 content equal-height">
    <div class="content-area-right">
     <div class="content-crumb-div">
        <a href="https://portal.oundleschool.org.uk/login/login.aspx?prelogin=https%3a%2f%2fportal.oundleschool.org.uk%2f.html">Intranet</a>/ <a href = "index.php"> Retry Login</a>/ Forgot Password
     </div>
        <div class="row">
           <div class="col-md-5 forgot-form">
              <p>Please enter your email address below and we will send you information to change your password.</p>
              <form action = "forgot_password.php" method = "post"><label class="label-default" for="un">Email Address</label><input id="email_addy" name="email" class="form-control" type="text"><br>
              <input type = "submit" value="Request password"></form>
           </div>
           <div class="col-md-5 forgot-return" style="display:none;">
              <h3>Reset Password Sent</h3>
              <p>An email has been sent to your address with a reset password you can use to access your account.</p>
           </div>
        </div>
     </div>
  </div>
</body>
</html>
