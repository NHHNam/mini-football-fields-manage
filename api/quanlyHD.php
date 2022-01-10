<?php
    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
    }
    $error = "";
    $success = "";
    $tongThanhToan = 0;
    if(isset($_POST['approve'])){
        $doanhThu = $_POST['doanhThu'];
        $maDonAp = $_POST['maDonAp'];
        $status = "Success";
        $date = date("Y-m-d");
        $result1 = update_status_hoa_don_by_staff($status, $maDonAp);
        if(check_date_exists($date) === true){
            $result2 = update_to_doanh_thu(1, $doanhThu, $date);
        }else{
            $result2 = add_to_doanh_thu(1, $doanhThu, $date);
        }

        if($result1['code'] == 0){
            $success = $result1['message'];
            get_maSan($maDonAp);
        }else{
            $error = $result1['message'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang duyệt hoá đơn</title>
    <link rel="stylesheet" href="../css/index.css">
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
    $resultGetInfo = get_all_staff($_SESSION['username']);
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
<div class="container">
    <a style="text-decoration: none;" href="../nhanVien.php"><i class="fas fa-arrow-circle-left"></i></a>
    <table class="table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Mã Đơn Hàng</th>
            <th>Mã Khách hàng</th>
            <th>Hình thức</th>
            <th>Ngày lập</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="table-body">
        <?php
            $stt = 1;
            $status = "Waiting";
            $result = get_all_hoa_don_by_staff($status);
            if($result['code'] == 0){
                $dataHoaDon = $result['data'];
                foreach($dataHoaDon as $a){
                    ?>
                        <tr>
                            <td><?=$stt?></td>
                            <td><?=$a['maDon']?></td>
                            <td><?=$a['maKH']?></td>
                            <td><?=$a['hinhthuc']?></td>
                            <td><?=$a['ngayLap']?></td>
                            <td><?=product_price($a['tongtien'])?></td>
                            <td><?=$a['status']?></td>
                            <form method="post">
                                <input type="hidden" name="doanhThu" value="<?=$a['tongtien']?>">
                                <input type="hidden" name="maDonAp" value="<?=$a['maDon']?>">
                                <td><input type="submit" value="Approve" name="approve"></td>
                            </form>
                        </tr>
                    <?php
                    $stt += 1;
                }
            }
        ?>
        </tbody>
    </table>
</div>
<?php
    if(!empty($error)){
        echo '<div class="alert alert-danger">'.$error.'</div>';
    }else if(!empty($success)){
        echo '<div class="alert alert-success">'.$success.'</div>';
    }
?>
</body>
</html>