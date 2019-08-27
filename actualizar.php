<?php
//script se encarga de actualizar fecha de record via crontab 

date_default_timezone_set("America/New_York");
$servername = "localhost";
$username = "root";
$password = "M3tr02017";
$dbname = "accidentes";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT fecha_inicial, fecha_record FROM fecha_historico";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
       $date=  $row["fecha_inicial"];
       $record=  $row["fecha_record"];
    }
}
$conn->close();
$then = new DateTime($date);
$now = new DateTime();
$sinceThen = $then->diff($now);
$diff=date_diff($then,$now);
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "UPDATE fecha_historico SET fecha_record = ".$diff->format("%a")."";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
	
?>
