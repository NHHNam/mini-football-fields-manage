<?php 
    define('host','localhost');
    define('user','root');
    define('password','');
    define('db','cnpm');
    
    function open_database(){
        $conn = mysqli_connect(host,user,password,db);
        if($conn->connect_error){
            die('Error connecting to database');
        }
        return $conn;
    }

    function login_admin($username,$password){
        $conn = open_database();
        $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$username,$password);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($result->num_rows == 0){
            return array('code' => 2, 'message' => "User not exist");
        }
        return array('code' => 0, 'message' =>'','data' =>$data);
    }

    function login($username, $password){
        $conn = open_database();
        $sql = "SELECT * FROM khachhang WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$username,$password);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($result->num_rows == 0){
            return array('code' => 2, 'message' => "User not exist");
        }
        return array('code' => 0, 'message' =>'','data' =>$data);
    }

    function get_all_admin($username){
        $conn = open_database();
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$username);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' => 'Data is not exist');
        }
        $data = $result->fetch_assoc();
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }
    function get_all_khachhang($username){
        $conn = open_database();
        $sql = "SELECT * FROM khachhang WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$username);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' => 'Data is not exist');
        }
        $data = $result->fetch_assoc();
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function get_all_san(){
        $conn = open_database();
        $sql = "SELECT * FROM sanbong";
        $stmt = $conn->prepare($sql);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $dataResult[] = $row;
        }
        return array('code' => 0, 'message' => 'Lấy dữ liệu thành công', 'data'=>$dataResult);
    }

    function get_image_banner(){
        $conn = open_database();
        $sql = "SELECT * FROM sanbong";
        $stmt = $conn->prepare($sql);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        $dataResult = array();
        while($row = $result->fetch_assoc()){
            if(sizeof($dataResult) < 3)
            $dataResult[] = $row;
        }
        return array('code' => 0, 'message' => 'Lấy dữ liệu thành công', 'data'=>$dataResult);
    }

    function get_all_user_khachhang(){
        $conn = open_database();
        $sql = "SELECT * FROM khachhang";
        $stmt = $conn->prepare($sql);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $dataResult[] = $row;
        }
        return array('code' => 0, 'message' => 'Lấy dữ liệu thành công', 'data'=>$dataResult);
    }
?>