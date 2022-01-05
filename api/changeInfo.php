<?php 
    session_start();
    require_once("../db.php");
    if(!$_SESSION["username"]){
        header("Location: ../login.php");
    }
    $usernameAccount = $_SESSION["username"];
    $resultGetInfo = get_all_khachhang($usernameAccount);
    if($resultGetInfo['code'] == 0){
        $data = $resultGetInfo['data'];
    }else{
        $error = $resultGetInfo['message'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password page</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        .container {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container form {
            width: 100%;
            padding: 20px;
            max-width: 600px;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.2);
            border-radius: 30px;
        }
        form div.header p{
            text-align: center;
            font-size: 40px;
            font-weight: 800;
            line-height: 50px;
        }
        .header a i{
            font-size: 30px;
            line-height: 50px;
            color: black;   
        }
        .header a{
            text-decoration: none;
        }

        .header{
            display: flex;
            justify-content: space-around;
            border-bottom: 1px solid #ccc;
            line-height: 50px;
        }
    </style>
</head>
<body>

<div class="col-lg-12 col-12">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mr-auto" href="index.php">Trang chủ</a>
            <form class="form-inline my-2 my-lg-0">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?="../".$data['image']?>" alt="Anh dai dien" style="max-width: 60px; max-height: 60px;">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="xemHoaDon.php">Đơn hàng</a>
                        <a class="dropdown-item" href="gioHang.php">Giỏ hàng</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</div>
<?php 
    if(isset($_POST['changeInfo'])){
        $nameChange = $_POST['name'];
        $addressChange = $_POST['address'];
        $genderChange = $_POST['gender'];
        $resultChange = change_info_khachhang($nameChange, $addressChange, $genderChange, $usernameAccount);
        if($resultChange['code'] == 0){
            $success = $resultChange['message'];
        }else{
            $error = $resultChange['message'];
        }
    }
?>
<div class="container">
    <form method="post">
        <div class="form-group header">
            <a href="chiTietUser.php"><i class="fas fa-arrow-circle-left"></i></a>
            <p>Thay đổi thông tin</p>
        </div>
        <div class="form-group">
            <label ><i class="fas fa-user"></i> Họ và tên:</label>
            <input type="text" class="form-control" name="name" value="<?=$data['name']?>">
        </div>

        <div class="form-group">
            <label ><i class="fas fa-user"></i> Địa chỉ:</label>
            <input type="text" class="form-control" name="address" value="<?=$data['diachi']?>">
        </div>

        <div class="input-group form-group">
            <label class="form-check-inline"><i class="fas fa-transgender"></i> Giới tính:</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender"  value="Nam">
                <label class="form-check-label" for="inlineRadio1">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender"  value="Nữ">
                <label class="form-check-label" for="inlineRadio2">Nữ</label>
            </div>
        </div>

        <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
            <?php
            if(!empty($error)){
                echo "<div class='alert alert-danger'>$error</div>";
                $error = "";
            }else if(!empty($success)){
                echo "<div class='alert alert-success'>$success</div>";
                $success = "";
            }
            ?>
        </p>
        <button type="submit" name="changeInfo" class="btn btn-primary w-100">Đổi thông tin</button>
    </form>
</div>
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>
</body>
</html>