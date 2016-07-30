<?php
header('Content-Type: application/json');
require("../inc/login.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if($conn->connect_error) {

} else {
	$u_id = $_GET['u_id'];
	$sql = "SELECT html, css, js, ip
	FROM test
	WHERE 1=1
		AND u_id = '$u_id'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$html = $row['html'];
			$css = $row['css'];
			$js = $row['js'];
			$ip = $row['ip'];
		}
		$message = "{ \"html\": \"$html\", \"css\": \"$css\", \"js\": \"$js\", \"ip\": \"$ip\" }";
	} else {
		$message = "";
	}
}
echo $message;
?>
