<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

include_once 'config/config.php';
$constant_get_query = "SELECT * FROM constant";
$result = mysqli_query($db, $constant_get_query);
$constant = mysqli_fetch_assoc($result);
if(isset($constant)){
$constant = $constant["constant"];
}
$parameter =$_POST['parameter_value'];
$sinus =$_POST['sinus_value'];
$cosinus =$_POST['cosinus_value'];
$sinus_cosinus =$_POST['sinus_cosinus_value'];
echo $cosinus;
if(isset($constant) && isset($sinus) && isset($cosinus) && isset($sinus_cosinus) ){
    $query = "UPDATE constant set constant='$parameter',sinus='$sinus',cosinus='$cosinus',sinus_cosinus='$sinus_cosinus' where constant = '$constant'";
    mysqli_query($db, $query);
}else{
    if(isset($parameter) ){
        $query = "INSERT INTO constant (constant) VALUES ('$parameter')";
        mysqli_query($db, $query);
    }
}
