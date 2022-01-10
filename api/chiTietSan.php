<?php
session_start();
require_once("../db.php");
$tenSanGet = $_GET['tenSan'];
$curDate = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index page</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        a i{
            font-size: 30px;
        }

        button.btn a{
            text-decoration: none;
            color: #fff;
        }
        
        .card {
            margin-top: 30px;
        }
        .card a img{
            max-height: 200px;
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
if(!empty($_SESSION['username'])){
    $error = "";
    $resultGetInfo = get_all_khachhang($_SESSION['username']);
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
                    <img src="<?="../".$data['image']?>" alt="Anh dai dien" style="max-width: 60px; max-height: 60px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="chiTietUser.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
        </form>
    </div>
    <?php
}else{
    ?>
    <div class="d-flex justify-content-around col-12 col-lg-12 navbar" style="background: lightblue;">
            <a class="col-lg-10 col-8 nav-link align-items-center" href="#">Trang index</a>
            <form class="form-inline my-2 my-lg-0 col-lg-2 col-4 align-items-center">
                <a class="nav-link" href="login.php">Login</a>
            </form>
        </div>
    <?php
}
?>

<?php
    $success = "";
    $error = "";
    if(isset($_POST['datSan'])){
        if(empty($_SESSION['username'])){
            $message = "Bạn chưa đăng nhập nên chưa thể vào giỏ hàng. Nên bạn hãy đăng nhập <a href='../login.php'>Đăng nhập</a>";
            $error = $message;
        }else{
            $username = $_POST['usernameKH'];
            $maSan = $_POST['maSan'];
            $ngayDat = $_POST['ngayDat'];
            $gioDat = $_POST['gioDat'];
            $thoigian = $_POST['thoigian'];
            $maDon = "";
            $resultCheckDate = check_date_dat_san($maSan, $ngayDat, $gioDat, $thoigian);
            if($resultCheckDate['code'] == 0) {
                $resultAdd = add_gio_hang($username, $maSan, $ngayDat, $gioDat, $thoigian,$curDate);
                $resultAdd1 = add_gio_hang_san_tam($maDon, $username, $maSan, $ngayDat, $gioDat, $thoigian,$curDate);
                if($resultAdd1['code'] != 0){
                    echo "Canot add to gio hang san tam";
                }
                if($resultAdd['code'] == 0){
                    $success = $resultAdd['message'];
                }else{
                    $error = $resultAdd['message'];
                }
            }else{
                $error = $resultCheckDate['message'];
            }
        }
    }else if(isset($_POST['buyDrink']) && isset($_SESSION['username'])){ 
        $maKH = $_SESSION['username'];
        $SL = $_POST['SL'];
        $maDrink = $_POST['maDrink'];
        $maDon = "";
        if(check_exist_drink($maDrink)){
            $resultAddDrink = update_drink_giohang($_SESSION['username'], $maDrink, $SL, $curDate);
            update_drink_giohang_tam($_SESSION['username'], $maDrink, $SL);
        }else{
            $resultAddDrink = add_drink_into_giohang($maDrink, $maKH, $SL, $curDate);
            add_drink_into_giohang_tam($maDon, $maDrink, $maKH, $SL);
        }
        if($resultAddDrink['code'] == 0){
            $success = "Đã thêm nước vào trong giỏ hàng";
        }else{
            $error = $resultAddDrink['message'];
        }
    }else if(!(isset($_SESSION['username'])) && isset($_POST['buyDrink'])){
        $error = "Không thể đặt nước vì bạn chưa đăng nhập <a href='login.php'>Đăng nhập</a>";
    }else{
        echo "";
    }
?>

    <?php
        if(!empty($error)){
            echo "<div class='alert alert-danger mt-2'>$error</div>";
        }else if(!empty($success)){
            echo "<div class='alert alert-success mt-2'>$success</div>";
        }
    ?>
<a style="text-decoration: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    <?php
        $result = get_chitiet_san($tenSanGet);
        if($result['code'] == 0){
            $data1 = $result['data'];
        }
    ?>
    <div class="row">
        <div class="col-lg-8 col-12 col-md-5">
            <img src="<?="../".$data1['imageSan']?>" style="max-width: 500px; max-height: 500px;">
        </div>
        <div class="col-lg-4 col-12 col-md-7">
            <?php
            if(!empty($_SESSION['username'])){
                ?>
                    <form method="post">
                        <h2>Tên sân: <?=$data1['tenSan']?></h2>
                        <h3>Giá sân: <?=product_price($data1['giaSan'])?> / Trận</h3>
                        <h3>Address: <?=$data1['addressSan']?></h3>
                        <h3>Chi tiết: <?=$data1['descSan']?></h3>
                        <input type="hidden" name="usernameKH" value="<?=$_SESSION['username']?>">
                        <input type="hidden" name="maSan" value="<?=$data1['maSan']?>">
                        <input type="date" name="ngayDat">
                        <input type="time" name="gioDat">
                        <select name="thoigian">
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                            <option value="60">60</option>
                        </select>
                        <input type="hidden" name="ngayLap" value="<?php echo date("Y/m/d");?>">
                        <input type="submit" name="datSan" value="Đặt sân" class="btn btn-success">
                    </form>
                    <?php
                }else{
                    ?>
                    <form method="post">
                        <h2>Tên sân: <?=$data1['tenSan']?></h2>
                        <h2>Giá sân: <?=product_price($data1['giaSan'])?> / Trận</h2>
                        <h2>Address: <?=$data1['addressSan']?></h2>
                        <h2>Chi tiết: <?=$data1['descSan']?></h2>
                        <input type="date" name="ngayDat">
                        <input type="time" name="gioDat">
                        <select name="thoigian">
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                            <option value="60">60</option>
                        </select>
                        <input type="submit" name="datSan" value="Đặt sân" class="btn btn-success">
                    </form>
                    <?php
                }
            ?>

        </div>
    </div>
    <h3 style="margin-top: 30px;">Danh sách các sản phẩm dùng trong sân: </h3>  
    <?php 
        
    ?>
    <div class="row">
        <?php
            $resultGetDrink = get_drink();
            if($resultGetDrink['code'] == 0){
                $data = $resultGetDrink['data'];
                foreach($data as $a){
                    ?>
                    <div class="col-lg-4 col-12 col-md-6">
                        <div class="card">
                            <a href=""><img src="<?="../".$a['imageDrink']?>" class="card-img-top" alt="hình nước ngọt"></a>
                            <div class="card-body">
                                <h5 class="card-title">Tên nước: <?=$a['nameDrink']?></h5>
                                <p class="card-text">Giá: <?=product_price($a['priceDrink'])?></p>
                                <form method="post">
                                    <div class="mb-3">
                                        <span><label for="SLDrink">Số lượng</label></span>
                                        <span><input type="number" name="SL" id="SLDrink"></span>
                                    </div>
                                    <input type="hidden" name="maDrink" value="<?=$a['maDrink']?>">
                                    <input type="submit" name="buyDrink" class="btn btn-primary" value="Đặt">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else{
                echo $resultGetDrink['message'];
            }
        ?>
    </div>
    
</div>
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>

</body>
</html>