<?php
require_once('../db.php');
$maSan = $_POST['maSan'];
$result = delete_san($maSan);
if($result['code'] == 0){
    echo "<div class='alert alert-success'>".$result['message']."</div>";
    sleep(1);
    header("Location: dsSanBong.php");
}else{
    echo "<div class='alert alert-danger'>".$result['message']."</div>";
    sleep(1);
    header("Location: dsSanBong.php");
}
?>