<?php
session_start();
require_once("db.php");
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
    <title>Trang nhân viên</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<?php    
    $resultGetInfo = get_all_staff($_SESSION['username']);
    if($resultGetInfo['code'] == 0){
        $data = $resultGetInfo['data'];
    }else{
        $error = $resultGetInfo['message'];
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mr-auto" href="#">Trang nhân viên</a>
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
    <?php
?>

<div class="container" style="min-height: 80vh;">
    <div class="row">
        <div class="col-lg-6 col-12 col-md-6">
            <div class="card">
                <a href="api/quanlyHD.php"><img src="images/manager.png" style="max-height: 400px;" class="card-img-top" alt="hình quản lý hoá đơn"></a>
                <div class="card-body">
                    <h1 class="card-title">Chấp thuận hoá đơn</h1>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12 col-md-6">
            <div class="card">
                <a href="api/checkHoaDon.php"><img src="images/checkin.jpeg" style="max-height: 400px;" class="card-img-top" alt="hình quản lý hoá đơn"></a>
                <div class="card-body">
                    <h1 class="card-title">Kiểm tra hoá đơn</h1>
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