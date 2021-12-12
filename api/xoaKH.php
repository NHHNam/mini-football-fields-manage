<?php
require_once('../db.php');
$id = $_POST['id'];
$result = delete_khachhang($id);
if($result['code'] == 0){
    echo "<div class='alert alert-success'>".$result['message']."</div>";
    sleep(1);
    header("Location: dsKhachhang.php");
}else{
    echo "<div class='alert alert-danger'>".$result['message']."</div>";
    sleep(1);
    header("Location: dsKhachhang.php");
}
?>