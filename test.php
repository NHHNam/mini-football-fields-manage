<?php 
    require_once("db.php");
    $date = date('Y-m-d');
    echo "".$date;
    if(check_date_exists($date) === true){
        echo "match";
    }else{
        echo "no match";
    }
?>