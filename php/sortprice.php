<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = 'vzk5158';
$password = '1234';
$host = 'localhost';
$dbname = 'project';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $sql = 'SELECT s.hid, l.address, l.zip, b.style, b.color, b.construction, i.bedrooms, i.garage, i.basement, u.water, u.ac, u.heating, i.size, a.type, a.school, s.price 
            FROM vzk5158_sellboard as s, vzk5158_location as l, vzk5158_built as b, vzk5158_info as i, vzk5158_utilitles as u, vzk5158_area as a
            WHERE s.hid =  l.hid
            AND l.hid = i.hid
            AND i.hid = b.hid
            AND b.hid = u.hid
            AND l.zip = a.zip
            ORDER BY s.price';
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
/*
$conn = new mysqli($host, $username, $password, $dbname);
    $sql = 'SELECT s.hid, s.address FROM vzk5158_sellboard as s';
    $q = $conn->query($sql);
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>House for Sale!</title>
    </head>
    <body>
        <div id="container">
            <h2>Current available houses for sale</h2>
            <h4>SORT BY</h4>
            <form action="/sortprice.php" method="post"><input type="submit" value="PRICE"></form>
            <form action="/sortzip.php" method="post"><input type="submit" value="ZIP"></form>
            <form action="/sortsize.php" method="post"><input type="submit" value="SIZE"></form>
            <form action="/sortbedrooms.php" method="post"><input type="submit" value="BEDROOMS"></form>
            <table border=1 cellspacing=3 cellpadding=1>
                <thead>
                    <tr>
                        <th>hid</th>
                        <th>address</th>
                        <th>zip</th>
                        <th>style</th>
                        <th>color</th>
                        <th>construction</th>
                        <th>bedrooms</th>
                        <th>garage</th>
                        <th>basement</th>
                        <th>water</th>
                        <th>ac</th>
                        <th>heating</th>
                        <th>size (acers)</th>
                        <th>type</th>
                        <th>school</th>
                        <th>price</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $q->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['hid']) ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['zip']); ?></td>
                            <td><?php echo htmlspecialchars($row['style']); ?></td>
                            <td><?php echo htmlspecialchars($row['color']); ?></td>
                            <td><?php echo htmlspecialchars($row['construction']); ?></td>
                            <td><?php echo htmlspecialchars($row['bedrooms']); ?></td>
                            <td><?php echo htmlspecialchars($row['garage']); ?></td>
                            <td><?php echo htmlspecialchars($row['basement']); ?></td>
                            <td><?php echo htmlspecialchars($row['water']); ?></td>
                            <td><?php echo htmlspecialchars($row['ac']); ?></td>
                            <td><?php echo htmlspecialchars($row['heating']); ?></td>
                            <td><?php echo htmlspecialchars($row['size']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td><?php echo htmlspecialchars($row['school']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo '<form action="/delete.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="hid" value="' . htmlspecialchars($row['hid']) . '"></form>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <br><h2>Update the price:</h2>
		<form action="/update.php" method="post">
			<table>
				<tr><td>hid:</td><td><input type="text" id="hid" name="hid" value="?"></td></tr>
                <tr><td>price:</td><td><input type="decimal" id="price" name="price" value="0"></td></tr>
			</table>
			<input type="submit" value="UPDATE">
		</form>
		<br>
		<br><br><br>

		<br><h2>Insert a new house:</h2>
		<form action="/insert.php" method="post">
			<table>
				<tr><td>hid:</td><td><input type="text" id="hid" name="hid" value="?"></td></tr>
				<tr><td>address:</td><td><input type="text" id="address" name="address" value="?"></td></tr>
				<tr><td>zip:</td><td><input type="text" id="zip" name="zip" value="?"></td></tr>
                <tr><td>style:</td><td><input type="text" id="style" name="style" value="?"></td></tr>
                <tr><td>color:</td><td><input type="text" id="color" name="color" value="?"></td></tr>
                <tr><td>construction:</td><td><input type="text" id="construction" name="construction" value="?"></td></tr>
                <tr><td>bedrooms:</td><td><input type="int" id="bedrooms" name="bedrooms" value="0"></td></tr>
                <tr><td>garage:</td><td><input type="text" id="garage" name="garage" value="?"></td></tr>
                <tr><td>basement:</td><td>
                    <input type="radio" id="basement" name="basement" value="none"> none
                    <input type="radio" id="basement" name="basement" value="crawl space"> crawl space
                    <input type="radio" id="basement" name="basement" value="full but unfinished"> full but unfinished
                    <input type="radio" id="basement" name="basement" value="full and finished"> full and finished
                </td></tr>
                <tr><td>water:</td><td>
                    <input type="radio" id="water" name="water" value="well"> well
                    <input type="radio" id="water" name="water" value="municipal"> municipal
                </td></tr>
                <tr><td>AC:</td><td>
                    <input type="radio" id="ac" name="ac" value="none"> none
                    <input type="radio" id="ac" name="ac" value="window"> window
                    <input type="radio" id="ac" name="ac" value="central"> central
                    <input type="radio" id="ac" name="ac" value="mini-split"> mini-split
                </td></tr>
                <tr><td>heating type:</td><td>
                    <input type="radio" id="heating" name="heating" value="coal"> coal
                    <input type="radio" id="heating" name="heating" value="wood"> wood
                    <input type="radio" id="heating" name="heating" value="gas"> gas
                    <input type="radio" id="heating" name="heating" value="electric"> electric
                </td></tr>
                <tr><td>size:</td><td><input type="float" id="size" name="size" value="0"></td></tr>
                <tr><td>price:</td><td><input type="decimal" id="price" name="price" value="0"></td></tr>
			</table>
			<input type="submit" value="INSERT">
		</form>
		<br>
		<br><br><br>
    </body>
</div>
</html>
