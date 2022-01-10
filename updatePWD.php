<?php 
    session_start();
    require_once("db.php");
    if(!$_SESSION["username"]){
        header("Location: login.php");
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
    <title>Trang thay đổi mật khẩu</title>
    <link rel="stylesheet" href="css/index.css">
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

<div class="d-flex justify-content-around col-12 col-lg-12 navbar" style="background: lightblue;">
    <a class="col-lg-10 col-6 nav-link align-items-center" href="#">Trang quản lý sân bóng mini</a>
    <form class="form-inline my-2 my-lg-0 col-lg-2 col-6 align-items-center">
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?=$data['image']?>" alt="Anh dai dien" style="max-width: 60px; max-height: 60px;">
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="api/chiTietUser.php">Thông tin cá nhân</a>
                <a class="dropdown-item" href="api/xemHoaDon.php">Đơn hàng</a>
                <a class="dropdown-item" href="api/gioHang.php">Giỏ hàng</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    </form>
</div>
<?php 
    if(isset($_POST['changePWD'])){
        $oldpwd = $_POST['oldpwd'];
        $newpwd = $_POST['newpwd'];
        $cpwd = $_POST['cpwd'];

        $result1 = change_password($oldpwd, $newpwd, $cpwd, $usernameAccount);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
        }
    }
?>
<div class="container">
    <form method="post">
        <div class="form-group header">
            <a href="api/chiTietUser.php"><i class="fas fa-arrow-circle-left"></i></a>
            <p>Thay đổi mật khẩu</p>
        </div>
        <div class="form-group">
            <label for="pwdold"><i class="fas fa-key"></i> Mật khẩu cũ:</label>
            <input type="password" class="form-control" id="pwdold" name="oldpwd" value="<?php if(!empty($oldpwd)) echo $oldpwd; ?>" placeholder="Nhập mật khẩu">
        </div>
        <div class="form-group">
            <label for="newpwd"><i class="fas fa-key"></i> Mật khẩu mới:</label>
            <input type="password" class="form-control" id="newpwd" name="newpwd" value="<?php if(!empty($newpwd)) echo $newpwd; ?>" placeholder="Nhập mật khẩu">
        </div>
        <div class="form-group">
            <label for="cpwd"><i class="fas fa-key"></i> Nhập lại mật khẩu:</label>
            <input type="password" class="form-control" id="cpwd" name="cpwd" value="<?php if(!empty($cpwd)) echo $cpwd; ?>" placeholder="Nhập mật khẩu">
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
        <button type="submit" name="changePWD" class="btn btn-primary w-100">Đổi mật khẩu</button>
    </form>
</div>
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>
</body>
</html>