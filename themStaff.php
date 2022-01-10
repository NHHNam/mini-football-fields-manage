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
$success = "";
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
    if(isset($_POST['addUser'])){
        $username = "nv".$_POST['accountname'];
        $name = $_POST['nameNV'];
        $pwd = "nv".$_POST['accountname'];

        $email = $_POST['emailNV'];
        $sdt = $_POST['sdtNV'];
        $address = $_POST['addrNV'];
        $gender = $_POST['gender'];
        $hinh = "images/".$_FILES['hinhDaiDien']['name'];
        move_uploaded_file($_FILES['hinhDaiDien']['tmp_name'], $hinh);
        $result1 = add_new_staff($name, $email, $sdt, $address, $gender, $username, $pwd, $hinh);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
        }
    }
?>
<div class="container">
    <a style="text-decoreation: none;" href="api/dsNv.php"><i class="fas fa-arrow-circle-left"></i></a>
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form novalidate method="post" enctype="multipart/form-data">
                    <h3>Thêm nhân viên mới</h3>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="nameNV" placeholder="Nhập tên người dùng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="emailNV" placeholder="Nhập email người dùng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="sdtNV" placeholder="Nhập số điện thoại người dùng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="addrNV" placeholder="Nhập địa chỉ người dùng">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend mr-1">
                            <span class="input-group-text"><i class="fas fa-transgender"></i></span>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"  value="Nam">
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"  value="Nữ">
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                        </div>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="accountname" placeholder="Nhập tên tài khoản">
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
                        <input type="submit" class="btn btn-primary form-control" name="addUser" value="Thêm nhân viên">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>