<?php
header('Content-Type: application/json');
require("inc/login.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if($conn->connect_error) {

} else {
	$u_id = $_GET['u_id'];
	$sql = "SELECT html, css, js, ip, privacy_flag, title
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
			$privacy = $row['privacy_flag'];
			$title = $row['title'];
		}
		$message = "{ \"html\": \"$html\", \"css\": \"$css\", \"js\": \"$js\", \"ip\": \"$ip\", \"privacy_flag\": \"$privacy\",
			\"title\": \"$title\", \"status\": \"ok\" }";
	} else {
		$message = "{ \"status\": \"error\" }";
	}
}
echo $message;
$conn->close();
?>
