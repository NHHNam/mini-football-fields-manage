<?php 
    session_start();
    require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang nhap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php 
        $error = "";
        if(isset($_POST['login'])){
            $accountName = $_POST['accountName'];
            $pwd = $_POST['pwd'];
            if($accountName == "admin"){
                $result = login_admin($accountName, $pwd);
                if($result['code'] == 0){
                    $data = $result['data'];
                    $_SESSION['username'] = $data['username'];
                    header("Location: admin.php");
                    exit();
                }else{
                    $error = $result['message'];
                }
            }else{
                $result = login($accountName, $pwd);
                if($result['code'] == 0){
                    $data = $result['data'];
                    $_SESSION['username'] = $data['username'];
                    header("Location: index.php");
                    exit();
                }else{
                    $error = $result['message'];
                }
            }
        }
    ?>
    <div class="container">
        <h2>Login form</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="accountName">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
            <div class="form-group">
                <?php 
                    if(!empty($error)){
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                ?>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>