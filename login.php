<?php
session_start();
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang nhap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body{
            background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-login{
            background: white;
            border-radius: 5%;
            width: 500px;
            padding: 20px 20px;
            box-shadow: 5px 10px 10px rgba(0,0,0,0.3);
        }

        .form-login p{
            text-align: center;
            font-size: 45px;
            border-bottom: 1px solid #5e5e5e;
            font-weight: 600;
        }
    </style>
</head>
<body>
<?php
$error = "";
$checkStaff = "nv";

if(isset($_POST['login'])){
    $accountName = $_POST['accountName'];
    $pwd = $_POST['pwd'];
    $result = login($accountName, $pwd);
    if($result['code'] == 0){
        $data = $result['data'];
        if($data['capBac'] == "quanly"){
            $_SESSION['username'] = $data['username'];
            header("Location: admin.php");
            exit();
        }else if($data['capBac'] == "nhanvien"){
            $_SESSION['username'] = $data['username'];
            header("Location: nhanVien.php");
            exit();
        }else if($data['capBac'] == "khachhang"){
            $_SESSION['username'] = $data['username'];
            header("Location: index.php");
            exit();
        }else{
            $error = "User is not exists";
        }
    }else{
        $error = $result['message'];
    }
}
?>
<div class="container">
    <div class="form-login">
        <p>Đăng nhập</p>
        <form method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input type="text" class="form-control" value="<?php if(!empty($accountName)) echo $accountName?>" id="email" placeholder="Nhập tên đăng nhập" name="accountName">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" value="<?php if(!empty($pwd)) echo $pwd?>" id="pwd" placeholder="Nhập mật khẩu" name="pwd">
            </div>
            <div class="form-group">
                <?php
                if(!empty($error)){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
                ?>
            </div>
            <div class="form-group">
                Nếu bạn chưa có tài khoản ? <a href="./register.php">Đăng ký</a>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
</body>
</html>