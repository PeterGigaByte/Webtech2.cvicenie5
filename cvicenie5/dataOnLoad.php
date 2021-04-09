<?php
include_once 'config/config.php';
$constant_get_query = "SELECT * FROM constant";
$result = mysqli_query($db, $constant_get_query);
$constant = mysqli_fetch_assoc($result);
$array = array();
if(isset($constant)){
    array_push($array,$constant);
    echo json_encode($array);
}