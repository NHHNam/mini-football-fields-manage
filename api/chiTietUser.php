<?php
    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
    }
    $error = "";
    $success = "";
    $tongThanhToan = 0;
    // echo date("Y/m/d");
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
        #wrap-form{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 90px;
        }

        #wrap-form #wrapper{
            max-height: 700px;
            overflow-y: auto;
            margin-top:30px;
            box-shadow: 5px 5px 5px 10px rgba(0,0,0,0.3);
            border-radius: 30px;
        }

        #wrap-form #wrapper div.form-group img{
            max-width: 500px;
            border-radius: 30px 30px 0 0;
        }

        #wrap-form #wrapper .details{
            padding: 10px
        }

        #wrap-form #wrapper .details .form-group label{
            font-size: 25px;
            font-weight: 600;
        }

        #wrap-form #wrapper .details .form-group p{
            font-size: 20px;            
        }
        .group-function{
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .header{
            display: flex;
            justify-content: space-around;
            align-items: center;
            line-height: 40px;
            border-bottom: 1px solid #ccc;
        }

        .header a i{
            line-height: 40px;
        }
        .header p{
            line-height: 40px;
            font-size: 30px;
            font-weight: 500;
        }
        .form-group{
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
<?php
if(!empty($_SESSION['username'])){
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
}
?>
<div class="container col-12 col-lg-12">
    <div id="wrap-form">
        <div id="wrapper">
            <div class="form-group">
                <img src="<?="../".$data['image']?>" class="col-12" alt="">
            </div>
            <div class="header">
                <?php 
                    if($data['capBac'] == "khachhang"){
                        ?>
                            <a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
                        <?php
                    }else if($data['capBac'] == "nhanvien"){
                        ?>
                            <a style="text-decoreation: none;" href="../nhanVien.php"><i class="fas fa-arrow-circle-left"></i></a>
                        <?php
                    }else{
                        ?>
                            <a style="text-decoreation: none;" href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>
                        <?php
                    }
                ?>
                <p>Thông tin khách hàng</p>
            </div>
            <div class="details">
                <div class="form-group">
                    <label for="">Họ và tên:</label>
                    <p><?=$data['name']?></p>
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <p><?=$data['email']?></p>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại:</label>
                    <p><?=$data['sdt']?></p>
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ:</label>
                    <p><?=$data['diachi']?></p>
                </div>
                <div class="form-group">
                    <label for="">Giới tính:</label>
                    <p><?=$data['gender']?></p>
                </div>
                
                <div class="group-function">
                    <a href="../updatePWD.php" class="btn btn-primary">Thay đổi mật khẩu</a>
                    <a href="./changeInfo.php" class="btn btn-primary">Thay đổi thông tin</a>
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