<?php
session_start();
require_once('db.php');
if(!$_SESSION["username"]){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang thêm sân</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        .nav-item .dropdown{
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle .dropdown-menu{
            max-width: 50px;
        }
        a i{
            font-size: 30px;
            margin-bottom: 30px;
            margin-top: 30px;
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
$error = "";
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

<?php
$error = "";
$success = "";
if(isset($_POST['addSan'])){
    $nameSan = $_POST['nameSan'];
    $maSan = $_POST['maSan'];
    $priceSan = $_POST['priceSan'];
    $addrSan = $_POST['addrSan'];
    $descSan = $_POST['descSan'];
    $hinhSan = "images/". $_FILES['hinhSan']['name'];
    if(move_uploaded_file($_FILES['hinhSan']['tmp_name'], $hinhSan)){
        $resultAddSan = add_new_san($maSan, $nameSan, $priceSan, $hinhSan, $addrSan, $descSan);
        if($resultAddSan['code'] == 0){
            $success = $resultAddSan['message'];
        }else{
            $error = $resultAddSan['message'];
        }
    }
}
?>
<div class="container">
    <a style="text-decoration: none;" href="api/dsSanBong.php"><i class="fas fa-arrow-circle-left"></i></a>
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form novalidate method="post" enctype="multipart/form-data">
                    <h3>Thêm sân bóng mới</h3>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-futbol"></i></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="nameSan" placeholder="Nhập tên của sân bóng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-futbol"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="maSan" placeholder="Nhập mã của sân bóng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="number" name="priceSan" placeholder="Nhập giá thuê">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="addrSan" placeholder="Nhập địa chỉ sân">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                        <textarea class="input-group-text form-control" name="descSan" placeholder="Nhập chi tiết sân"></textarea>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="file" name="hinhSan">
                    </div>
                    <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                        <?php
                        if(!empty($error)){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }else if(!empty($success)){
                            echo "<div class='alert alert-success'>$success</div>";
                        }
                        ?>
                    </p>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success  form-control"name="addSan" value="Thêm sân bóng">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>