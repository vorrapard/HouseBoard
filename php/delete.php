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
        <title>Deleting house for sale</title>
    </head>
    <body>
		<p>
			<?php 
				echo "hid: " . $_POST["hid"] . " "; 
				$sql = 'DELETE FROM vzk5158_sellboard WHERE hid = "' . $_POST["hid"] . '"';
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo "is deleted successfully <br>";
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
