<?php
    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
    }
    $error = "";
    $success = "";
    $tongThanhToan = 0;
    $maDon = "Don" . rand(1,10000);
    $tongTien = $_GET['tongTien'];
    // echo date("Y/m/d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        button.btn a{
            text-decoration: none;
            color: #fff;
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
if(!empty($_SESSION['username'])){
    $resultGetInfo = get_all_khachhang($_SESSION['username']);
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
                    <img src="<?="../".$data['image']?>" alt="Anh dai dien" style="max-width: 60px; max-height: 60px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="chiTietUser.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
        </form>
    </div>
    <?php
}
?>
<a style="text-decoreation: none;" href="gioHang.php"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    <h4>Danh sách sân đặt: </h4>
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên sân đặt</th>
            <th>Ngày đặt</th>
            <th>Giờ đặt</th>
            <th>Thời gian</th>
        </tr>
        </thead>
        <tbody id="table-body">
        <?php
            $stt = 1;
            $tongTienSan = 0;
            $result = get_gio_hang_tam($_SESSION['username'], "");
            if($result['code'] == 0){
                $dataKhachHang = $result['data'];
                foreach($dataKhachHang as $a){
                    ?>
                    <tr>
                        <td><?=$stt?></td>
                        <td><?=$a['maSan']?></td>
                        <td><?=$a['ngaydat']?></td>
                        <td><?=$a['giodat']?></td>
                        <td><?=$a['thoigian']?></td>
                    </tr>
                    <?php
                    update_maDon_san($a['id'], $maDon);
                    $stt+=1;
                }
            }else{
                echo $result['message'];
            }
        ?>
        </tbody>
    </table>
    <h4>Danh sách nước đặt: </h4>
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên nước</th>
            <th>Số lượng</th>
        </tr>
        </thead>
        <tbody id="table-body">
        <?php
            $tongDrink = 0;
            $stt1 = 1;
            $result1 = get_drink_giohang_drink_tam($_SESSION['username'], "");
            if($result1['code'] == 0){
                $data1 = $result1['data'];
                foreach($data1 as $a){
                    ?>
                        <tr>
                            <td><?=$stt1 ?></td>
                            <td><?=$a['maDrink']?></td>
                            <td><?=$a['soluong']?></td>
                        </tr>
                    <?php
                    update_maDon_drink($a['id'], $maDon);
                    $stt1+=1;
                }
            }else{
                echo $result1['message'];
            }
        ?>
        </tbody>
    </table>
    <h4>Tổng tất cả tiền: <?=product_price($tongTien)?></h4>
    <div>

    <?php 
        
        if(isset($_POST['thanhToan'])){
            $hinhThucThanhToan = $_POST['hinhThucThanhToan'];
            $tongTien = $_POST['tongTien'];
            $maKH = $_POST['maKH'];
            $ngayLap = date("Y-m-d");
            $status = "Waiting";
            $maDon = $_POST['maDon'];
            $result3 = thanh_toan($maKH, $maDon, $hinhThucThanhToan, $tongTien, $ngayLap, $status);
            if($result3['code'] == 0){
                $success = $result3['message'];
                xoa_all_dat_san($maKH);
                xoa_all_dat_drink($maKH);
            }else{
                $error = $result3['message'];
            }
        }
    ?>
    <form method="post">
        <label>Hình thức thanh toán: </label>
        <select name="hinhThucThanhToan">
            <option value="Trực tiếp">Trực tiếp</option>
            <option value="MoMo">MoMo</option>
            <option value="Thẻ ngân hàng">Thẻ ngân hàng</option>
        </select>
        <input type="hidden" name="maDon" value="<?=$maDon?>">
        <input type="hidden" name="listSan" value="<?=$lSan?>">
        <input type="hidden" name="listDrink" value="<?=$lDrink?>">
        <input type="hidden" value="<?=$tongTien?>" name="tongTien">
        <input type="hidden" value="<?=$_SESSION['username']?>" name="maKH">
        <input type="submit" class="btn btn-primary form-control" name="thanhToan" value="Thanh toán">
    </div>
    </form>



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
</div>
</body>
</html>