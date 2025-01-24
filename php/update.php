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
        <title>Updating price</title>
    </head>
    <body>
		<p>
			<?php 
				echo "Updating price for hid: " . $_POST["hid"] . " with new price: $" . $_POST["price"] . "<br>"; 
				$sql = 'UPDATE vzk5158_sellboard SET price = ' . $_POST["price"] . ' WHERE hid = "' . $_POST["hid"] . '";';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "New record created successfully";
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
