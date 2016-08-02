<?php
require("inc/login.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if($conn->connect_error) {

} else {
	$json = json_decode($_POST['message']);
	$privacy = $json->value;
	$u_id = $json->u_id;
	$title = $json->title;
	$ip = $_SERVER["REMOTE_ADDR"];
	$sql = "UPDATE test
		SET privacy_flag = $privacy, title = \"$title\"
		WHERE u_id = \"$u_id\" AND IP = \"$ip\"";
	$conn->query($sql);
	$conn->close();
}
