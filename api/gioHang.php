<?php
    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
    }
    $error = "";
    $success = "";
    $curDate = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giỏ hàng</title>
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
<a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    <h4>Danh sách sân đặt: </h4>
    <table class="table">
        <thead>
        <tr>
            <th>Tên sân đặt</th>
            <th>Ngày đặt</th>
            <th>Giờ đặt</th>
            <th>Thời gian</th>
            <th>Tổng tiền</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="table-body">
        <?php
            $tongTienSan = 0;
            $result = get_gio_hang($_SESSION['username']);
            if($result['code'] == 0){
                $dataKhachHang = $result['data'];
                foreach($dataKhachHang as $a){
                    $tongTienSan += $a['thoigian'] * $a['giaSan'];
                    ?>
                    <tr>
                        <td><?=$a['tenSan']?></td>
                        <td><?=$a['ngaydat']?></td>
                        <td><?=$a['giodat']?></td>
                        <td><?=$a['thoigian']?></td>
                        <td><?=product_price($a['thoigian'] * $a['giaSan'])?></td>
                        <form method="post">
                            <input type="hidden" name="username" value="<?=$_SESSION['username']?>" />
                            <input type="hidden" name="maSanToDelete" value="<?=$a['maSan']?>">
                            <input type="hidden" name="gioDat" value="<?=$a['giodat']?>">
                            <td><button class="btn btn-danger" name="del" type="submit">Delete</button></td>
                        </form>
                    </tr>
                    <?php
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
            <th>Tên nước</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="table-body">
        <?php
            $tongDrink = 0;
            $result1 = get_drink_giohang($_SESSION['username']);
            if($result1['code'] == 0){
                $data1 = $result1['data'];
                foreach($data1 as $a){
                    $tongDrink += $a['priceDrink'] * $a['soluong'];
                    ?>
                        <tr>
                            <td><?=$a['nameDrink']?></td>
                            <td><?=$a['soluong']?></td>
                            <td><?=$a['priceDrink']?></td>
                            <td><?=product_price($a['soluong'] * $a['priceDrink'])?></td>
                            <form method="post">
                                <input type="hidden" name="username" value="<?=$_SESSION['username']?>" />
                                <input type="hidden" name="maDrinkToDel" value="<?=$a['maDrink']?>" />
                                <td><button class="btn btn-danger" name="delDrink" type="submit">Delete</button></td>
                            </form>
                        </tr>
                    <?php
                }
            }else{
                echo $result1['message'];
            }
        ?>
        </tbody>
    </table>
    <h4>Tổng tất cả tiền: <?=product_price($tongTienSan + $tongDrink)?></h4>
    <a class="btn btn-primary" href="hoaDon.php?tongTien=<?=$tongTienSan + $tongDrink?>">Thanh toán</a>
</div>

<?php
    if(isset($_POST['del'])){
        $maSanToDel = $_POST['maSanToDelete'];
        $usernameKH = $_POST['username'];
        $gioDat = $_POST['gioDat'];
        $result1 = delete_san_gio_hang($maSanToDel, $curDate, $usernameKH);
        $result2 = delete_san_tam_gio_hang($maSanToDel, $curDate, $usernameKH, $gioDat);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
        }
    }else if(isset($_POST['delDrink'])){
        $usernameKH = $_POST['username'];
        $maDrinkToDel = $_POST['maDrinkToDel'];
        $result2 = delete_nuoc_giohang($maDrinkToDel,$curDate, $usernameKH);
        if($result2['code'] == 0){
            $success = $result2['message'];
        }else{
            $error = $result2['message'];
        }
    }
?>
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
</body>
</html>