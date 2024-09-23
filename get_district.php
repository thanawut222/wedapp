<?php
include('connect.php');

$sql_district = "SELECT * FROM district WHERE prefecture_ID={$_GET['prefecture_ID']}";
$query = mysqli_query($con, $sql_district);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);