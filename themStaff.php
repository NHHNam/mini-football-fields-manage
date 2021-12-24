<?php
session_start();
require_once('db.php');
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
    <title>Trang giám đốc</title>
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
    </style>
</head>
<body>
<?php
$success = "";
$error = "";
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

<?php
    if(isset($_POST['addUser'])){
        $username = "nv". $_POST['accountname'];
        $name = $_POST['nameKH'];
        $pwd = $_POST['pwd'];
        $hinh = "images/".$_FILES['hinhDaiDien']['name'];
        move_uploaded_file($_FILES['hinhDaiDien']['tmp_name'], $hinh);
        $result1 = add_new_staff($name, $username, $pwd, $hinh);
        if($result1['code'] == 0){
            $success = $result1['message'];
        }else{
            $error = $result1['message'];
        }
    }
?>
<div class="container">
    <a style="text-decoreation: none;" href="api/dsNv.php"><i class="fas fa-arrow-circle-left"></i></a>
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form novalidate method="post" enctype="multipart/form-data">
                    <h3>Thêm nhân viên mới</h3>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="nameKH" placeholder="Enter name of NV">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="text" name="accountname" placeholder="enter username of NV">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="password" name="pwd" placeholder="Enter password of NV">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div>
                        <input class="input-group-text form-control" type="file" name="hinhDaiDien">
                    </div>
                    <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                        <?php
                        if(!empty($error)){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }else if(!empty($success)){
                            echo "<div class='alert alert-success'>$success</div>";
                        }
                        ?>
                    </p>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary form-control" name="addUser" value="Thêm nhân viên">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>