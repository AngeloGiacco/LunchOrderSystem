<?php
array_map("htmlspecialchars", $_POST);
include_once("connection.php");
try{
	$email = $_GET["email"];
	$house = $_GET["house"];
	$surname = $_GET["surname"];
	$forename = $_GET["forename"];
	$token = $_GET["token"];
	$stmt = $conn->prepare("SELECT * FROM pupils");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		if ($row["email"] == $email){
			?><script>
        if (window.confirm('Unfortunately there is already an account associated with this email. Please try again with another one by pressing ok or contact the system administrator.')){
          window.location.href='index.php';
        } else {
					window.location.href='index.php';
				};
      </script><?php
			exit();
		}
	}
	if ($_POST["psw"] == $_POST["psw-repeat"]) {
		$stmt = $conn->prepare("UPDATE pupils SET forename = :forename, surname = :surname, house = :house, email = :email WHERE token = :token");
		$stmt->bindParam(':forename', $forename);
		$stmt->bindParam(':surname', $surname);
		$stmt->bindParam(':house', $house);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':token', $token);
		$stmt->execute();
		$_POST = array();
		$conn=null;
	} else {
		?><script>
			if (window.confirm('Unfortunately the passwords you entered did not match. Please retry')){
				window.location.href='order.php';
			} else {
				window.location.href='order.php';
			};
		</script><?php
	}
	$conn=null;
	header('Location: index.php');
	exit();
}
catch(PDOException $e){
		echo "error".$e->getMessage();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<link rel = "stylesheet" type = "text/css" href = "success.css" />
</head>
<body>
	<div class="screen un">
    <div class="border-top">
      </div>

        <svg width="166" height="150" id="topIcon"><g id="Shot" fill="none" fill-rule="evenodd"><g id="shot2" transform="translate(-135 -157)"><g id="success-card" transform="translate(48 120)"><g id="Top-Icon" transform="translate(99.9 47.7)"><g id="Bubbles" fill="#5AE9BA"><g id="bottom-bubbles" transform="translate(0 76)"><ellipse id="Oval-Copy-3" cx="12.8571429" cy="13.2605405" rx="12.8571429" ry="12.8432432"/><ellipse id="Oval-Copy-4" cx="25.0714286" cy="34.4518919" rx="8.35714286" ry="8.34810811"/><ellipse id="Oval-Copy-6" cx="42.4285714" cy="31.2410811" rx="7.71428571" ry="7.70594595"/></g><g id="top-bubbles" transform="translate(92)"><ellipse id="Oval" cx="13.4285714" cy="23.76" rx="12.8571429" ry="12.8432432"/><ellipse id="Oval-Copy" cx="37.8571429" cy="25.0443243" rx="5.14285714" ry="5.1372973"/><ellipse id="Oval-Copy-2" cx="30.1428571" cy="7.70594595" rx="7.71428571" ry="7.70594595"/></g></g><g id="Circle" transform="translate(18.9 11.7)"><ellipse id="blue-color" cx="56.341267" cy="54.0791109" fill="#5AE9BA" rx="51.2193336" ry="51.5039151"/><ellipse id="border" cx="51.2283287" cy="51.5039151" stroke="#3C474D" stroke-width="5" rx="51.2193336" ry="51.5039151"/><path id="bluetooth" fill="#FFF" fill-rule="nonzero" d="M51.2028096 52.9593352l12.1775292-9.6235055c.3644184-.2872475.5941296-.714554.6368262-1.1784596.0426967-.4637471-.111547-.924167-.4168832-1.2724131l-13.444407-15.2100186c-.4628885-.5249041-1.201336-.7047309-1.8545476-.4570927-.6532117.2492225-1.0831718.8780617-1.0831718 1.5794653v22.4403228l-7.2604808-6.778123c-.6729057-.6321664-1.739692-.5957257-2.3732097.0874576-.6335176.6849262-.5941295 1.7543806.0887019 2.3881314l8.3601956 7.8097108-8.2551082 6.5239889c-.7319878.575921-.8567692 1.6388795-.2856422 2.3732382.5744355.7361016 1.6379132.8598414 2.3599753.2839204L47.2181554 56.1067v21.3906731c0 .663537.3841124 1.2641743.9847016 1.5381131.2232516.1023508.4595799.1517833.6959083.1517833.4004979 0 .7943785-.1435445 1.1061744-.4174833l13.444407-11.8300673c.3578012-.315291.5678183-.7690566.5744355-1.2476968.0066172-.4786403-.1871721-.9374759-.538356-1.26259L51.2028096 52.9593352zM50.579092 31.546148l9.603625 10.6136051-9.603625 7.4127652V31.546148zm0 42.49073V57.2981056l8.9633833 8.6179286-8.9633833 8.1208438z"/></g></g></g></g></g></svg>

        <h3>SUCCESS!</h3>
        <p>You have successfully verified your account and fully signed up.</p>
          <a href ="order.php"><button id="btnClick">Order a Packed Lunch</button></a>
        </div>

        <a href = "index.php"><button type="button" id="restart" class="btn-overlay restart tr">Home</button></a>
        <a href="forgot_password.php"><button type="button" id="invert" class="btn-overlay invert tr">Forgot Password?</button></a>
</body>
</html>
