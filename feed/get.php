<?php
require("../inc/login.php");
$json = "[";
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if($conn->connect_error) {
	echo "Błąd połączenia z bazą danych";
} else {
	$sql = "SELECT u_id, title, dt
		FROM test
		WHERE privacy_flag = 0
		ORDER BY dt DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$title = $row['title'];
			$dt = strtotime($row['dt']);
			$u_id = $row['u_id'];
			$json .= "{ \"title\": \"$title\", \"u_id\": \"$u_id\", \"date\": \"$dt\" },";
		}
	}
}
$json = rtrim($json, ",") . "]";
echo $json;
?>
