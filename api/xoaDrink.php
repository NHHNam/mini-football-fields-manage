<?php
require_once('../db.php');
$maDrink = $_POST['maDrink'];
$result = xoa_drink($maDrink);
if($result['code'] == 0){
    echo "<div class='alert alert-success'>".$result['message']."</div>";
    sleep(1);
    header("Location: dsDrink.php");
}else{
    echo "<div class='alert alert-danger'>".$result['message']."</div>";
    sleep(1);
    header("Location: dsDrink.php");
}
?>