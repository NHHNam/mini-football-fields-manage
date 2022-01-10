<?php
session_start();
require_once("db.php");
if(!$_SESSION["username"]){
    header("Location: login.php");
}else if($_SESSION["username"] != "admin"){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .button-setup {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .button-setup button{
        margin-right: 20px;
    }

    .button-setup button a{
        text-decoration: none;
        color: #fff;
    }
    a{
        text-decoration: none;
    }
    a.nav-link{
        font-size: 20px;
        color: #fff;
    }
</style>
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

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-12 col-md-6 mb-2 mt-2">
            <div class="card">
                <a href="api/dsSanBong.php"><img style="height: 300px" src="images/modelSan.jpg" class="card-img-top" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title">Quản lý sân bóng</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 col-md-6 mb-2 mt-2">
            <div class="card">
                <a href="api/dsKhachhang.php"><img style="height: 300px" src="images/customer.jpeg" class="card-img-top" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title">Quản lý khách hàng</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 col-md-6 mb-2 mt-2">
            <div class="card">
                <a href="api/dsNv.php"><img style="height: 300px" src="images/staff.jpeg" class="card-img-top" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title">Quản lý nhân viên</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 col-md-6 mb-2 mt-2">
            <div class="card">
                <a href="api/dsDrink.php"><img style="height: 300px" src="images/drink.jpeg" class="card-img-top" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title">Quản lý nước</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 col-md-6 mb-2 mt-2">
            <div class="card">
                <a href="doanhThu.php"><img style="height: 300px" src="images/chart.jpeg" class="card-img-top" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title">Thống kê doanh thu</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12 col-md-6 mb-2 mt-2">
            <div class="card">
                <a href="api/thongKeSanDatNhieu.php"><img style="height: 300px" src="images/datNhieu.jpeg" class="card-img-top" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title">Thống kê sân đặt nhiều</h5>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>
</body>
</html>