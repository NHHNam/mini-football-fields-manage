<?php 
    session_start();
    require_once("../db.php");
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
    <title>Admin page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>

</style>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mr-auto" href="../admin.php">Trang Admin</a>
            <form class="form-inline my-2 my-lg-0">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?=$data['name']?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
            </form>
        </div>
    </nav>
    <div class="container">
    <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php 
                    $result = get_all_user_khachhang();
                    if($result['code'] == 0){
                        $dataKhachHang = $result['data'];
                        foreach($dataKhachHang as $a){
                        ?>
                            <tr>
                                <td><?=$a['id']?></td>
                                <td><img src="
                                    <?php 
                                        echo "../".$a['image'];
                                    ?>
                                " style="max-width: 80px;"></td>
                                <td><?=$a['name']?></td>
                                <td><?=$a['username']?></td>
                                <td><?=$a['password']?></td>
                                <td><a href="">Delete</a> | <a href="">Edit</a></td>
                            </tr>
                        <?php
                        }
                    }
                ?>

            </tbody>
        </table>
    </div>
</body>
</html>