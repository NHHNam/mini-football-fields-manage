<?php
session_start();
require_once("db.php");
$resultBanner = get_image_banner();
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
            <a class="navbar-brand mr-auto" href="#">Trang index</a>
            <form class="form-inline my-2 my-lg-0">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?=$data['image']?>" alt="Anh dai dien" style="max-width: 60px;">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="api/gioHang.php">Giỏ hàng</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
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
            <a class="navbar-brand mr-auto" href="#">Trang Admin</a>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="login.php">Login</a>
            </form>
        </div>
    </nav>
    <?php
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-12 col-md-5">
            <p class="name-app">Quận</p>
            <div class="category">
                <ul>
                    <li class="active">Quận Bình Tân</li>
                    <li>Quận Tân Phú</li>
                    <li>Quận 11</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 col-12 col-md-7">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    $imageBanner = $resultBanner['data'];
                    foreach($imageBanner as $a){
                        ?>
                        <div class="carousel-item
                            <?php
                        if($i == 0){
                            echo 'active';
                        }
                        ?>">
                            <a href="api/chiTietSan.php?tenSan=<?=$a['tenSan']?>"><img class="d-block" src="<?=$a['imageSan']?>" alt="First slide"></a>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="row">
                <?php
                $resultGetSan = get_all_san();
                if($resultGetSan['code'] == 0){
                    $data = $resultGetSan['data'];
                    foreach($data as $a){
                        ?>
                        <div class="col-lg-4 col-12 col-md-6">
                            <div class="card">
                                <a href="api/chiTietSan.php?tenSan=<?=$a['tenSan']?>"><img src="<?=$a['imageSan']?>" class="card-img-top" alt="hinh san bong"></a>
                                <div class="card-body">
                                    <h5 class="card-title"><?=$a['tenSan']?></h5>
                                    <p class="card-text"><?=$a['giaSan']?> / phút</p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo $resultGetSan['message'];
                }
                ?>


            </div>
        </div>
    </div>
</div>
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>
</body>
</html>