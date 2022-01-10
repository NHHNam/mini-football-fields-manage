<?php
session_start();
require_once("db.php");
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
    <title>Trang Doanh Thu</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
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
                    <a class="dropdown-item" href="api/xemHoaDon.php">Đơn hàng</a>
                    <a class="dropdown-item" href="api/gioHang.php">Giỏ hàng</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <a style="text-decoreation: none;" href="admin.php"><i class="fas fa-arrow-circle-left"></i></a>
        <p>Thống kê đơn hàng theo: <span id="text-date"></span></p>
        <p>
            <select class="select-date">
                <option>--Chọn loại thống kê--</option>
                <option value="7ngay">7 ngày qua</option>
                <option value="30ngay">30 ngày qua</option>
                <option value="90ngay">90 ngày qua</option>
                <option value="365ngay">365 ngày qua</option>
            </select>
        </p>
        <div id="chart" style="height: 250px;"></div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        

        $(document).ready(function(){
            thongke();
            var char = new Morris.Area({
                element: 'chart',
                parseTime: false,
                xkey: 'date',
                ykeys: ['date','doanhthu', 'sodon'],
                labels: ['Ngày đặt','Tổng tiền', 'Số đơn']
            });
            $('.select-date').change(function(){
                var thoigian = $(this).val();
                if(thoigian == '7ngay'){
                    var text = '7 ngày qua'
                }else if(thoigian == '30ngay'){
                    var text = '30 ngày qua'
                }else if(thoigian == '90ngay'){
                    var text = '90 ngày qua'
                }else{
                    var text = '365 ngày qua'
                }
                $.ajax({
                    url: "thongke.php",
                    method: 'POST',
                    dataType: 'JSON',
                    data: {thoigian: thoigian},
                    success: function(data){
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                })
            })
            function thongke(){
                var text = '365 ngày qua'
                $('#text-date').text(text);
                $.ajax({
                    url: "thongke.php",
                    method: 'POST',
                    dataType: 'JSON',
                    success: function(data){
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                })
            }
        });
    </script>
</body>
</html>