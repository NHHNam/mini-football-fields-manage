<?php
session_start();
require_once('db.php');
if(!$_SESSION["username"]){
    header("Location: login.php");
}
$error = "";
$success = "";
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
        .nav-item {
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle {
            max-width: 50px;
        }
        a i{
            font-size: 30px;
        }
    </style>
</head>
<body>
<?php
$resultGetInfo = get_all_admin($_SESSION['username']);
if($resultGetInfo['code'] == 0){
    $data = $resultGetInfo['data'];
}else{
    $error = $resultGetInfo['message'];
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <a class="navbar-brand mr-auto" href="#">Trang Admin</a>
        <form class="form-inline my-2 my-lg-0">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?=$data['image']?>" alt="Anh dai dien" style="max-width: 60px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </form>
    </div>
</nav>
<a style="text-decoreation: none;" href="api/dsKhachhang.php"><i class="fas fa-arrow-circle-left"></i></a>
<?php
$idOld = $_POST['id'];
if(isset($_POST['suaKH'])){
    $id = $_POST['id'];
    $ten = $_POST['ten'];
    $pwd = $_POST['pwd'];
    $hinh = "images/".$_FILES['hinh']['name'];
    move_uploaded_file($_FILES['hinh']['tmp_name'], $hinh);
    $result1 = update_khachhang($id, $ten, $pwd, $hinh);
    if($result1['code'] == 0){
        $success = $result1['message'];
    }else{
        $error = $result1['message'];
    }
}

?>
<div class="container">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input class="input-group" type="hidden" name="id" value="<?=$idOld?>">
            </div>
            <div class="form-group">
                <label>Tên khách hàng:</label>
                <input class="input-group" type="text" name="ten" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input class="input-group" type="password" name="pwd" required>
            </div>
            <div class="form-group">
                <label>Hình ảnh đại diện:</label>
                <input class="input-group" type="file" name="hinh" required>
            </div>
            <div class="form-group">
                <input class="input-group btn btn-success" name="suaKH" value="Sua KH" type="submit">
            </div>
            <div class="form-group">
                <?php
                if(!empty($error)){
                    echo "<div class='alert alert-danger'>$error</div>";
                }else if(!empty($success)){
                    echo "<div class='alert alert-success'>$success</div>";
                }
                ?>
            </div>
        </form>
    </div>
</div>



</div>
</body>
</html>
