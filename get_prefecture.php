<?php
include('connect.php');

$sql_prefecture = "SELECT * FROM prefecture WHERE province_ID={$_GET['province_ID']}";
$query = mysqli_query($con, $sql_prefecture);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);