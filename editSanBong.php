<?php
session_start();
require_once('db.php');
if(!$_SESSION["username"]){
    header("Location: login.php");
}
$error = "";
$success = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang sửa sân bóng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        .nav-item {
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle {
            max-width: 50px;
        }
        a i{
            font-size: 30px;
        }
        a{
            text-decoration: none;
        }
        a.nav-link{
            font-size: 20px;
            color: #fff;
        }
    </style>
</head>
<body>
<?php
$resultGetInfo = get_all_admin($_SESSION['username']);
if($resultGetInfo['code'] == 0){
    $data = $resultGetInfo['data'];
}else{
    $error = $resultGetInfo['message'];
}
?>
<div class="d-flex justify-content-around col-12 col-lg-12 navbar" style="background: lightblue;">
        <a class="col-lg-10 col-6 nav-link align-items-center" href="#">Trang quản lý sân bóng mini</a>
        <form class="form-inline my-2 my-lg-0 col-lg-2 col-6 align-items-center">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?=$data['image']?>" alt="Anh dai dien" style="max-width: 60px; max-height: 60px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="api/chiTietUser.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </form>
</div>
<a style="text-decoreation: none;" href="api/dsSanBong.php"><i class="fas fa-arrow-circle-left"></i></a>
<?php
    $ma = $_POST['maSan'];
    $result2 = get_info_san($ma);
    if($result2['code'] == 0){
        $data1 = $result2['data'];
    }else{
        $error = $result2['message'];
    }

    if(isset($_POST['suaSan'])){
        $maSan = $_POST['maSan'];
        $ten = $_POST['ten'];
        $gia = $_POST['gia'];
        $desc = $_POST['descSan'];
        $addressSan = $_POST['addressSan'];
        $result1 = update_san($ten, $gia, $maSan, $addressSan, $desc);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
        }
    }

?>
<div class="container">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input class="input-group" type="hidden" name="maSan" value="<?=$ma?>">
            </div>
            <div class="form-group">
                <label>Tên sân:</label>
                <input class="input-group" type="text" value="<?=$data1['tenSan']?>" name="ten" required>
            </div>
            <div class="form-group">
                <label>Giá:</label>
                <input class="input-group" type="number" value="<?=$data1['giaSan']?>" name="gia" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input class="input-group" type="text" value="<?=$data1['addressSan']?>" name="addressSan" required>
            </div>
            <div class="form-group">
                <label>Chi tiết:</label>
                <textarea class="input-group" name="descSan" cols="30" rows="10"><?=$data1['descSan']?></textarea>
            </div>
            <div class="form-group">
                <input class="input-group btn btn-success" name="suaSan" value="Sửa Sân" type="submit">
            </div>
            <div class="form-group">
                <?php
                if(!empty($error)){
                    echo "<div class='alert alert-danger'>$error</div>";
                }else if(!empty($success)){
                    echo "<div class='alert alert-success'>$success</div>";
                }
                ?>
            </div>
        </form>
    </div>
</div>



</div>
</body>
</html>
