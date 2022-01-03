<?php
session_start();
require_once("../db.php");
if(!$_SESSION["username"]){
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<style>
    a i{
        font-size: 30px;
        margin-bottom: 30px;
        margin-top: 30px;
    }
</style>
<body>
<?php
$error = "";
$success = "";
$resultGetInfo = get_all_admin($_SESSION['username']);
if($resultGetInfo['code'] == 0){
    $data = $resultGetInfo['data'];
}else{
    $error = $resultGetInfo['message'];
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="navbar-brand mr-auto" href="../admin.php">Trang Admin</a>
        <form class="form-inline my-2 my-lg-0">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= "../" . $data['image']?>" style="max-width: 50px; max-height: 50px" />
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
        </form>
    </div>
</nav>
<div class="container">
    <a style="text-decoreation: none; width: 50px;" href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th style="text-align: center;" colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody id="table-body">
        <?php
        $result = get_all_drink();
        $stt = 1;
        if($result['code'] == 0){
            $dataDrink = $result['data'];
            foreach($dataDrink as $a){
                ?>
                <tr>
                    <td><?=$stt?></td>
                    <td><img src="
                                    <?php
                        echo "../".$a['imageDrink'];
                        ?>
                                " style="max-width: 80px;"></td>
                    <td><?=$a['nameDrink']?></td>
                    <td><?=$a['priceDrink']?></td>
                    <form action="../editDrink.php" method="post">
                        <input type="hidden" name="maDrink" value="<?=$a['maDrink']?>">
                        <td style="text-align: center;"><button class="btn btn-success" type="submit">Edit</button></td>
                    </form>

                    <form action="xoaDrink.php" method="post">
                        <input type="hidden" name="maDrink" value="<?=$a['maDrink']?>">
                        <td style="text-align: center;"><button class="btn btn-danger" type="submit">Delete</button></td>
                    </form>
                </tr>
                <?php
                $stt+=1;
            }
        }
        ?>

        </tbody>
    </table>
    <button class="btn btn-success"><a style="text-decoration: none; color:white;" href="../themDrink.php">Thêm nước mới</a></button>
</div>
</body>
</html>