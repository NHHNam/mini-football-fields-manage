<?php
session_start();
require_once("db.php");
$resultBanner = get_image_banner();
$error = "";
$success = "";


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
    <style>
        .card a img{
            max-height: 200px;
        }
        a{
            text-decoration: none;
        }
        a.nav-link{
            font-size: 20px;
            color: #fff;
        }
        .list-group{
            top: 45px;
            position: absolute;
            z-index: 1;
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
        <a class="col-lg-6 col-12 nav-link align-items-center" href="#">Trang quản lý sân bóng mini</a>
        <div class="col-lg-4 col-12">
            <input type="text" oninput="suggest(this.value)" class="p-1 form-control col-6 col-lg-6 nameSearch" placeholder="Tìm kiếm sân">
            <ul class="list-group col-6 col-lg-6 suggestS"></ul></br>
        </div>
        <form class="form-inline my-2 my-lg-0 col-lg-2 col-12 align-items-center">
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
}else{
    ?>
        <div class="d-flex justify-content-around col-12 col-lg-12 navbar" style="background: lightblue;">
            <a class="col-lg-6 col-12 nav-link align-items-center" href="#">Trang quản lý sân bóng mini</a>
            <div class="col-lg-4 col-12">
                <input type="text" oninput="suggest(this.value)" class="p-1 form-control col-6 col-lg-6 nameSearch" placeholder="Tìm kiếm sân">
                <ul class="list-group col-6 col-lg-6 suggestS"></ul></br>
            </div>
            <form class="form-inline my-2 my-lg-0 col-lg-2 col-12 align-items-center">
                <a class="nav-link" href="login.php">Login</a>
            </form>
        </div>
    <?php
}
?>
<div class="container">
        <div class="col-lg-12 col-12 col-md-7 All">
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
                            <a href="api/chiTietSan.php?tenSan=<?=$a['tenSan']?>"><img style="height: 600px;" class="d-block" src="<?=$a['imageSan']?>" alt="First slide"></a>
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
            </br>
            
            </br>
            <h3>Danh sách các sân hiện có: </h3>
            <div class="row">
                <?php
                    $resultGetSan = get_all_san();
                    if($resultGetSan['code'] == 0){
                        $data = $resultGetSan['data'];
                        foreach($data as $a){
                            ?>
                            <div class="col-lg-4 col-12 col-md-6">
                                <div class="card">
                                    <a href="api/chiTietSan.php?tenSan=<?=$a['tenSan']?>"><img style="height: 300px" src="<?=$a['imageSan']?>" class="card-img-top" alt="hình sân bóng"></a>
                                    <div class="card-body">
                                        <h5 class="card-title">Tên sân: <?=$a['tenSan']?></h5>
                                        <p class="card-text">Giá: <?=product_price($a['giaSan'])?> / phút</p>
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
<div class="footer col-lg-12 col-12">
    <p>Quản lý sân bóng đá mini 2021.</p>
</div>
<script>
    let suggestions = document.querySelector(".suggestS");

    function suggest(value) {  
        sendRequest(value);
    }

    function sendRequest(word){
        suggestions.innerHTML = "";

        const xhr = new XMLHttpRequest();

        xhr.addEventListener('load', e => {
            if(xhr.status === 200 && xhr.readyState === 4){
                let response = xhr.responseText;
                response = JSON.parse(response);

                if(response.code === 0){
                    let data = response.data;
                    data.forEach(item =>{
                        const li = document.createElement('li')
                        li.className = 'list-group-item'
                        const a = `<a href="api/chiTietSan.php?tenSan=${item.tenSan}">${item.tenSan}</a>`
                        li.innerHTML = a;
                        suggestions.appendChild(li)
                    })
                }
            }
        })

        xhr.open('GET', 'sever.php?word=' + encodeURIComponent(word),true);
        xhr.send();
    }
</script>
</body>
</html>