<?php
    session_start();
    require_once('../db.php');
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mr-auto" href="../index.php">Trang index</a>
            <form class="form-inline my-2 my-lg-0">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?="../".$data['image']?>" alt="Anh dai dien" style="max-width: 60px;">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <?php
}
?>
<a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
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
        $result = get_gio_hang($_SESSION['username']);
        if($result['code'] == 0){
            $dataKhachHang = $result['data'];
            foreach($dataKhachHang as $a){
                $tong += $a['thoigian'] * $a['giaSan'];
                ?>
                <tr>
                    <td><?=$a['tenSan']?></td>
                    <td><?=$a['ngaydat']?></td>
                    <td><?=$a['giodat']?></td>
                    <td><?=$a['thoigian']?></td>
                    <td><?=product_price($a['thoigian'] * $a['giaSan'])?></td>
                    <form method="post">
                        <input type="hidden" name="maSanToDelete" value="<?=$a['maSan']?>">
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
    <h4>Tổng tất cả tiền: <?=product_price($tong)?></h4>
</div>

<?php
    if(isset($_POST['del'])){
        $maSanToDel = $_POST['maSanToDelete'];
        $result1 = delete_san_gio_hang($maSanToDel);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
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