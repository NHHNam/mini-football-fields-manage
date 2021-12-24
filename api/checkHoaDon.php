<?php
session_start();
require_once("../db.php");
if(!$_SESSION["username"]){
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        a i{
            font-size: 30px;
            margin-bottom: 30px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<?php
$error = "";
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
                    <img src="<?='../'.$data['image']?>" alt="Anh dai dien" style="max-width: 60px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
        </form>
    </div>
</nav>

<?php 
    $maDon = "";
    $idSan = 0;
    $idDrink = 0;
    if(isset($_POST['search'])){
        $maDon = $_POST['textHoaDon'];
    }
?>
<div class="container">
<a style="text-decoreation: none; width: 50px;" href="../nhanVien.php"><i class="fas fa-arrow-circle-left"></i></a>
    <div>
        <form method="post">
            <!-- Search form -->
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 red-border" name="textHoaDon" type="text" placeholder="Nhập mã đơn cần tìm" aria-label="Search">
                <div class="input-group-append">
                    <span class="ml-2"><input type="submit" class="btn btn-primary"value="Search" name="search"></span>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Mã khách hàng</th>
                <th>Hình thức đặt</th>
                <th>Tổng số tiền</th>
                <th>Ngày lập đơn</th>
                <th>Tình trạng đơn</th>
            </tr>
            </thead>
            <tbody id="table-body">
                <?php 
                    $result = search_hoadon($maDon);
                    if($result['code'] == 0){
                        $data1 = $result['data'];
                        ?>
                            <tr>
                                <td><?=$data1['maDon']?></td>
                                <td><?=$data1['maKH']?></td>
                                <td><?=$data1['hinhthuc']?></td>
                                <td><?=product_price($data1['tongtien'])?></td>
                                <td><?=$data1['ngayLap']?></td>
                                <td><?=$data1['status']?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Mã khách hàng</th>
                <th>Mã sân</th>
                <th>Ngày đặt</th>
                <th>Giờ đặt</th>
                <th>thời gian</th>
                <th>Ngày lập</th>
            </tr>
            </thead>
            <tbody id="table-body">
                <?php 
                    $result1 = search_san($maDon);
                    if($result1['code'] == 0){
                        $data2 = $result1['data'];
                        foreach($data2 as $a){
                            ?>
                                <tr>
                                    <td><?=$a['maKH']?></td>
                                    <td><?=$a['maSan']?></td>
                                    <td><?=$a['ngaydat']?></td>
                                    <td><?=$a['giodat']?></td>
                                    <td><?=$a['thoigian']?></td>
                                    <td><?=$a['ngayLap']?></td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Mã khách hàng</th>
                <th>Mã nước</th>
                <th>Số lượng</th>
            </tr>
            </thead>
            <tbody id="table-body">
                <?php 
                    $result2 = search_drink($maDon);
                    if($result2['code'] == 0){
                        $data3 = $result2['data'];
                        foreach($data3 as $a){
                            ?>  
                                <tr>
                                    <td><?=$a['maKH']?></td>
                                    <td><?=$a['maDrink']?></td>
                                    <td><?=$a['soluong']?></td>    
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>