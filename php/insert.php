<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'vzk5158';
$password = '1234';
$host = 'localhost';
$dbname = 'project';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inseting house for sale</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Inserting new hid: " . $_POST["hid"] . "<br>address: " . $_POST["address"] . "<br>zip: " . $_POST["zip"]; 
				echo "<br>style: " . $_POST["style"] . "<br>color: " . $_POST["color"] . "<br>construction: " . $_POST["construction"]; 
				echo "<br>bedrooms: " . $_POST["bedrooms"] . "<br>garage: " . $_POST["garage"] . "<br>basement: " . $_POST["basement"]; 
				echo "<br>water: " . $_POST["water"] . "<br>AC: " . $_POST["ac"] . "<br>heating: " . $_POST["heating"]; 
				echo "<br>size: " . $_POST["size"] . "<br>price: " . $_POST["price"]; 

				$sql = 'INSERT INTO vzk5158_sellboard ' . 'VALUES ("' . $_POST["hid"] . '","' . $_POST["price"] . '");';
				$sql .= 'INSERT INTO vzk5158_location ' . 'VALUES ("' . $_POST["hid"] . '","' . $_POST["address"] . '","' . $_POST["zip"] . '");';
				$sql .= 'INSERT INTO vzk5158_utilitles ' . 'VALUES ("' . $_POST["hid"] . '","' . $_POST["water"] . '","' . $_POST["ac"] . '","' . $_POST["heating"] . '");';
				$sql .= 'INSERT INTO vzk5158_info ' . 'VALUES ("' . $_POST["hid"] . '","' . $_POST["garage"] . '","' . $_POST["basement"] . '","' . $_POST["size"] . '","' . $_POST["bedrooms"] . '");';
				$sql .= 'INSERT INTO vzk5158_built ' . 'VALUES ("' . $_POST["hid"] . '","' . $_POST["style"] . '","' . $_POST["color"] . '","' . $_POST["construction"] . '");';

				try {
					//$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn = new mysqli($host, $username, $password, $dbname);
					//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//$conn->exec($sql);
					$conn->multi_query($sql);
					echo "<br>New data created successfully<br>";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='start.php'
					}, 3000);
				</script>
			<?php
				} catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
