<?php
session_start();
require_once('db.php');
// if(!$_SESSION["username"]){
//     header("Location: login.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giám đốc</title>
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
        
        .header{
            height: 40px;
        }

        .header a i{
            font-size: 30px;
            line-height: 40px;
        }

        .header p{
            font-size: 30px;
            line-height: 40px;
            font-weight: 600;
        }

        body{
            background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
        }

        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }   
    </style>
</head>
<body>

<?php
    $success = "";
    $error = "";
    if(isset($_POST['addUser'])){
        $username = $_POST['accountname'];
        $name = $_POST['nameKH'];
        $pwd = $_POST['pwd'];
        $hinh = "images/".$_FILES['hinhDaiDien']['name'];
        move_uploaded_file($_FILES['hinhDaiDien']['tmp_name'], $hinh);
        $result1 = register($name, $username, $pwd, $hinh);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
        }
    }
?>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form novalidate method="post" enctype="multipart/form-data">
                    <div class="form-group d-flex justify-content-around header">
                        <a style="text-decoreation: none;" href="login.php"><i class="fas fa-arrow-circle-left"></i></a>
                        <p>Đăng ký tài khoản</p>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="nameKH" placeholder="Nhập tên người dùng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="accountname" placeholder="Nhập tên tài khoản">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="password" name="pwd" placeholder="Nhập mật khẩu">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="file" name="hinhDaiDien">
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
                        <input type="submit" class="btn btn-primary form-control" name="addUser" value="Đăng ký tài khoản">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>