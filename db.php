<?php
    define('host', 'localhost');
    define('user', 'root');
    define('password', '');
    define('db','cnpm');

    function open_database(){
        $conn = mysqli_connect(host, user, password, db);
        if($conn->connect_errno){
            die("can not connect to databe");
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

    function check_san_exists($tenSan){
        $conn = open_database();
        $sql = "SELECT * FROM sanbong WHERE tenSan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$tenSan);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    function check_user_exists($username){
        $conn = open_database();
        $sql = "SELECT * FROM khachhang WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$username);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    function add_new_san($maSan, $tenSan, $giaSan, $imageSan){
        if(check_san_exists($tenSan) == true){
            return array('code' => 2, 'message'=>'Sân đã tồn tại vui lòng nhập tên sân khác');
        }
        $conn = open_database();
        $sql = "INSERT INTO sanbong (maSan, tenSan, giaSan, imageSan) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssis', $maSan, $tenSan, $giaSan, $imageSan);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        return array('code' => 0, 'message' => 'Thêm sân mới thành công');
    }

    function delete_san($maSan){
        $conn = open_database();
        $sql = "DELETE FROM sanbong WHERE maSan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maSan);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        return array('code' => 0, 'message' =>'Xoá sân thành công');
    }

    function get_info_san($maSan){
        $conn = open_database();
        $sql = "select * from sanbong where maSan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$maSan);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'Cannot execute the command');
        }

        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code'=>2, 'message'=>'Không tìm thấy kết quả');
        }
        $data = $result->fetch_assoc();
        return array('code'=>0, 'message'=>'','data'=>$data);
    }

    function update_san($tenSan, $giaSan,$maSan){
        $conn = open_database();
        $sql = "update sanbong set tenSan = ?, giaSan = ? where maSan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sis', $tenSan, $giaSan, $maSan);

        if(!$stmt->execute()){
            return  array('code'=>1, 'Can not query command');
        }
        if($stmt->affected_rows == 0){
            return array('code'=>3, 'message'=>'column is not exists');
        }
        return array('code'=>0, 'message'=>'Sửa sân thành công');
    }

    function add_new_khachhang($name, $username, $pwd, $image){
        if(check_user_exists($username) == true){
            return array('code' => 2, 'message'=>'Khách hàng đã tồn tại vui lòng nhập tên khác');
        }
        $conn = open_database();
        $sql = "INSERT INTO khachhang (name, username, password, image) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $username, $pwd, $image);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        return array('code' => 0, 'message' => 'Thêm khách hàng mới thành công');
    }

    function delete_khachhang($id){
        $conn = open_database();
        $sql = "DELETE FROM khachhang WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        return array('code' => 0, 'message' =>'Xoá khách hàng thành công');
    }

    function update_khachhang($id, $name, $password, $image){
        $conn = open_database();
        $sql = "update khachhang set name = ?, password = ?, image = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $name, $password, $image, $id);

        if(!$stmt->execute()){
            return  array('code'=>1, 'Can not query command');
        }
        if($stmt->affected_rows == 0){
            return array('code'=>3, 'message'=>'column is not exists');
        }
        return array('code'=>0, 'message'=>'Sửa khách hàng thành công');
    }

    function get_chitiet_san($tenSan){
        $conn = open_database();
        $sql = "select * from sanbong where tenSan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$tenSan);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'Cannot execute the command');
        }

        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code'=>2, 'message'=>'Không tìm thấy kết quả');
        }
        $data = $result->fetch_assoc();
        return array('code'=>0, 'message'=>'','data'=>$data);
    }

    function add_gio_hang($username, $maSan, $ngayDat, $gioDat, $thoigian,$ngayLap){
        $conn = open_database();
        $sql = "insert into giohang (username_khachhang, maSan, ngaydat, giodat, thoigian, ngayLap) values (?, ?, ?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param('ssssis', $username, $maSan, $ngayDat, $gioDat, $thoigian,$ngayLap);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'cannot execute command');
        }
        return array('code'=>0,'message'=>'Thêm vào giỏ hàng thành công');
    }

    function get_gio_hang($username){
        $conn = open_database();
        $sql = "SELECT * FROM giohang g, sanbong s WHERE g.maSan = s.maSan and g.username_khachhang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'cannot execute command');
        }

        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code'=>2, 'message'=>'Giỏ hàng không có sản phẩm nào :((');
        }
        while($row = $result->fetch_assoc()){
            $dataResult[] = $row;
        }
        return array('code' => 0, 'message' => 'Lấy dữ liệu thành công', 'data'=>$dataResult);
    }

    function product_price($priceFloat) {
        $symbol = ' VND';
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price.$symbol;
    }

    function delete_san_gio_hang($maSan){
        $conn = open_database();
        $sql = "delete from giohang where maSan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $maSan);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'cannot execute the command');
        }
        return array('code'=>0, 'message'=>'Xoá sản phẩm thành công');
    }
?>
