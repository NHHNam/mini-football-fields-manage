<?php
session_start();
require_once("../db.php");
$tenSanGet = $_GET['tenSan'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index page</title>
    <link rel="stylesheet" href="css/index.css">
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

        button.btn a{
            text-decoration: none;
            color: #fff;
        }
        .footer{
            padding: 10px;
            background: black;
            margin-top: 100px;
            color: white;
        }

        .footer p{
            text-align: center;
            font-size: 20px;
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mr-auto" href="../index.php">Trang index</a>
            <form class="form-inline my-2 my-lg-0">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?="../".$data['image']?>" style="max-width: 50px;">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <?php
}else{
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mr-auto" href="../index.php">Trang index</a>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="../login.php">Login</a>
            </form>
        </div>
    </nav>
    <?php
}
?>

<?php
    if(isset($_POST['datSan'])){
        if(empty($_SESSION['username'])){
            $message = "Bạn chưa đăng nhập nên chưa thể vào giỏ hàng";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>

<?php
    $success = "";
    $error = "";
    if(isset($_POST['datSan'])){
        $username = $_POST['usernameKH'];
        $maSan = $_POST['maSan'];
        $ngayDat = $_POST['ngayDat'];
        $gioDat = $_POST['gioDat'];
        $ngayLap = $_POST['ngayLap'];
        $thoigian = $_POST['thoigian'];
        $resultAdd = add_gio_hang($username, $maSan, $ngayDat, $gioDat, $thoigian,$ngayLap);
        if($resultAdd['code'] == 0){
            $success = $resultAdd['message'];
        }else{
            $error = $resultAdd['message'];
        }
    }
?>
<a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
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
                        <h3>Giá sân: <?=$data1['giaSan']?> / Trận</h3>
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
                        <h3>Giá sân: <?=$data1['giaSan']?> / Trận</h3>
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
</div>
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>
<?php
if(!empty($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}else if(!empty($success)){
    echo "<div class='alert alert-success'>$success</div>";
}
?>
</body>
</html>