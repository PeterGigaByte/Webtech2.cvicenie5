<?php
include_once "config/config.php";
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");
$x = 0;
$a = 1;
while (true){
    $constant_get_query = "SELECT * FROM constant";
    $result = mysqli_query($db, $constant_get_query);
    $constant = mysqli_fetch_assoc($result);
    //kostanta
    if(isset($constant["constant"])){
        if($constant["sinus"]=="false"){
            $sinus = "false";
        }
        else{
            $sinus = sin($x*$a)*sin($x*$a);
        }
        if($constant["cosinus"]=="false"){
            $cosinus = "false";
        }else{
            $cosinus=cos($x*$a)*cos($x*$a);
        }
        if($constant["sinus_cosinus"]=="false"){
            $sinus_cosinus = "false";
        }
        else{
            $sinus_cosinus = sin($x*$a)*cos($x*$a);
        }
        $a=$constant["constant"];
    }else{
        $a = 1;
        $sinus = sin($x*$a)*sin($x*$a);
        $cosinus=cos($x*$a)*cos($x*$a);
        $sinus_cosinus = sin($x*$a)*cos($x*$a);
    }
    $msg = json_encode([
        "a" => $a,
        "y1" => $sinus,
        "y2"=> $cosinus,
        "y3"=> $sinus_cosinus
    ]);
    sendSse($x++,$msg);
    sleep(1);
}
function sendSse($id,$msg){
    echo "id: $id\n";
    echo "event: evt\n";
    echo "data: $msg\n\n";

    ob_flush();
    flush();
}