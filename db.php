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

    function login_staff($username, $password){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$username,$password);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($result->num_rows == 0){
            return array('code' => 2, 'message' => "Nhân viên không tồn tại");
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

    function get_all_staff($username){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$username);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' => 'Dữ liệu của nhân viên không có');
        }
        $data = $result->fetch_assoc();
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function get_info($id){
        $conn = open_database();
        $sql = "SELECT * FROM khachhang WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
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

    function get_info_staff($id){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
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

    function check_staff_exists($username){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE username = ?";
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



    function add_new_staff($name, $username, $pwd, $image){
        if(check_staff_exists($username) == true){
            return array('code' => 2, 'message'=>'Nhân viên đã tồn tại vui lòng nhập tên khác');
        }
        $conn = open_database();
        $sql = "INSERT INTO nhanvien (name, username, password, image) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $name, $username, $pwd, $image);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        return array('code' => 0, 'message' => 'Thêm nhân viên mới thành công');
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

    function delete_NV($id){
        $conn = open_database();
        $sql = "DELETE FROM nhanvien WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' => "Can not execute command");
        }
        return array('code' => 0, 'message' =>'Xoá nhân viên thành công');
    }

    function update_khachhang($id, $name, $password){
        $conn = open_database();
        $sql = "update khachhang set name = ?, password = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $name, $password, $id);

        if(!$stmt->execute()){
            return  array('code'=>1, 'Can not query command');
        }
        if($stmt->affected_rows == 0){
            return array('code'=>3, 'message'=>'column is not exists');
        }
        return array('code'=>0, 'message'=>'Sửa khách hàng thành công');
    }

    function update_staff($id, $name, $password){
        $conn = open_database();
        $sql = "update nhanvien set name = ?, password = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $name, $password, $id);

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
        $sql = "insert into giohang (maKH, maSan, ngaydat, giodat, thoigian, ngayLap) values (?, ?, ?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param('ssssis', $username, $maSan, $ngayDat, $gioDat, $thoigian,$ngayLap);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'cannot execute command');
        }
        return array('code'=>0,'message'=>'Thêm vào giỏ hàng thành công');
    }

    function add_gio_hang_san_tam($maDon, $username, $maSan, $ngayDat, $gioDat, $thoigian,$ngayLap){
        $conn = open_database();
        $sql = "insert into tamgiohangsan (maDon, maKH, maSan, ngaydat, giodat, thoigian, ngayLap) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param('sssssis', $maDon, $username, $maSan, $ngayDat, $gioDat, $thoigian,$ngayLap);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'cannot execute command');
        }
        return array('code'=>0,'message'=>'Thêm vào giỏ hàng thành công');
    }

    function get_gio_hang($username){
        $conn = open_database();
        $sql = "SELECT * FROM giohang g, sanbong s WHERE g.maSan = s.maSan and g.maKH = ?";
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

    function get_gio_hang_tam($username, $maDon){
        $conn = open_database();
        $sql = "SELECT t.id, t.maKH, t.maSan, t.ngaydat, t.giodat, t.thoigian, t.ngayLap FROM tamgiohangsan t, sanbong s WHERE t.maSan = s.maSan and t.maKH = ? and t.maDon = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $maDon);

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
        return array('code'=>0, 'message'=>'Xoá sân trong giỏ hàng thành công');
    }

    function delete_nuoc_giohang($maDrink){
        $conn = open_database();
        $sql = "delete from giohangdrink where maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $maDrink);

        if(!$stmt->execute()){
            return array('code'=>1, 'message'=>'cannot execute the command');
        }
        return array('code'=>0, 'message'=>'Xoá nước trong giỏ hàng thành công');
    }
    

    function get_drink(){
        $conn = open_database();
        $sql = "select * from drink";
        $stmt = $conn->prepare($sql);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không có sản phẩm nào');
        }

        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function add_drink_into_giohang($maDrink, $maKH, $SL){
        $conn = open_database();
        $sql = "INSERT INTO giohangdrink (maDrink, maKH, soluong) values(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $maDrink, $maKH, $SL);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Can not execute command');
        }
        return array('code'=>0, 'message'=>'Đặt nước thành công');
    }

    function add_drink_into_giohang_tam($maDon, $maDrink, $maKH, $SL){
        $conn = open_database();
        $sql = "INSERT INTO tamgiohangdrink (maDon, maDrink, maKH, soluong) values(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $maDon, $maDrink, $maKH, $SL);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Can not execute command');
        }
        return array('code'=>0, 'message'=>'Đặt nước thành công');
    }

    function get_drink_giohang($maKH){
        $conn = open_database();
        $sql = "SELECT * FROM giohangdrink g, drink d WHERE g.maDrink = d.maDrink and g.maKH = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maKH);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không có loại nước uống nào trong giỏ hàng');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' => '','data' => $data);
    }

    function get_drink_giohang_drink_tam($maKH, $maDon){
        $conn = open_database();
        $sql = "SELECT t.id, t.maDrink, t.soluong, t.maKH FROM tamgiohangdrink t, drink d WHERE t.maDrink = d.maDrink and t.maKH = ? and t.maDon = ? ORDER BY t.id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $maKH, $maDon);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không có loại nước uống nào trong giỏ hàng');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' => '','data' => $data);
    }

    function check_exist_drink($maDrink){
        $conn = open_database();
        $sql = "SELECT * FROM giohangdrink WHERE maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$maDrink);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    function update_drink_giohang($maKH,$maDrink,$SL){
        $conn = open_database();
        $sql = "update giohangdrink set soluong = soluong + ? where maKH = ? and maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iss', $SL, $maKH, $maDrink);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Thêm nước thành công');
    }

    function update_drink_giohang_tam($maKH,$maDrink,$SL){
        $conn = open_database();
        $sql = "update tamgiohangdrink set soluong = soluong + ? where maKH = ? and maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iss', $SL, $maKH, $maDrink);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Thêm nước thành công');
    }

    function get_all_drink(){
        $conn = open_database();
        $sql = "SELECT * FROM drink";
        $stmt = $conn->prepare($sql);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'chưa thêm sản phẩm nước uống nào');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' => '', 'data' => $data);
    }

    function xoa_drink($maDrink){
        $conn = open_database();
        $sql = "delete from drink where maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maDrink);

        if(!$stmt->execute()){
            return array('code' => 0, 'message' => 'Cannot execute command');
        }
        return array('code' => 0, 'message' =>'Xoá nước thành công');
    }

    function add_new_drink($maDrink, $nameDrink, $priceDrink, $hinhDrink){
        if(check_exist_drink($maDrink) == true){
            return array('code' => 2, 'message'=>'Sản phẩm này đã tồn tại vui lòng nhập sản phẩm khác');
        }
        $conn = open_database();
        $sql = "INSERT INTO drink (maDrink, nameDrink, priceDrink, imageDrink) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssis', $maDrink, $nameDrink, $priceDrink, $hinhDrink);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Thêm nước mới thành công');
    }

    function get_info_drink($maDrink){
        $conn = open_database();
        $sql = "SELECT * FROM drink WHERE maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maDrink);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function update_drink($maDrink, $nameDrink, $priceDrink){
        $conn = open_database();
        $sql = "update drink set nameDrink = ?, priceDrink = ? WHERE maDrink = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sis', $nameDrink, $priceDrink, $maDrink);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        return array('code' => 0, 'message' =>'Sửa thông tin nước thành công');
    }

    function thanh_toan($maKH, $maDon, $hinhThucThanhToan, $tongTien, $ngayLap, $status){
        $conn = open_database();
        $sql = "insert into hoadon (maDon, maKH, hinhthuc, tongtien, ngayLap, status) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiss", $maDon, $maKH, $hinhThucThanhToan, $tongTien, $ngayLap, $status);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Đã gửi yêu cầu thanh toán');
    }

    function get_hoa_don($maKH){
        $allSan = get_gio_hang_tam($maKH);
        $allDrink = get_drink_giohang_drink_tam($maKH);
        return array('code' => 0, 'message' =>'', 'dataSan'=>$allSan['data'], 'dataDrink'=>$allDrink['data']);
    }

    function xoa_all_dat_san($maKH){
        $conn = open_database();
        $sql = "delete from giohang where maKH = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maKH);
        $stmt->execute();
    }

    function xoa_all_dat_drink($maKH){
        $conn = open_database();
        $sql = "delete from giohangdrink where maKH = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maKH);
        $stmt->execute();
    }

    function get_hoa_don_xuat($maKH){
        $conn = open_database();
        $sql = "select * from hoadon where maKH = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $maKH);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không có hoá đơn nào hết :((');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' => '', 'data' => $data);
    }

    function search_hoadon($maHoaDon){
        $conn = open_database();
        $sql = "SELECT * FROM hoadon WHERE maDon = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$maHoaDon);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không tồn tại hoá đơn');
        }
        $data = $result->fetch_assoc();
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function search_san($maDon){
        $conn = open_database();
        $sql = "SELECT * FROM tamgiohangsan WHERE maDon = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$maDon);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không tồn tại hoá đơn');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function search_drink($maDon){
        $conn = open_database();
        $sql = "SELECT * FROM tamgiohangdrink WHERE maDon = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$maDon);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Không tồn tại hoá đơn');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function get_all_hoa_don_by_staff($status){
        $conn = open_database();
        $sql = "select * from hoadon where status = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $status);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'hiện tại không có hoá đơn cần chấp thuận ^^');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code'=>0, 'message'=>'', 'data' =>$data);
    }

    function update_status_hoa_don_by_staff($status, $maDon){
        $conn = open_database();
        $sql = "update hoadon set status = ? where maDon = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $status, $maDon);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Đã chấp thuận hoá đơn ' . $maDon);
    }

    function update_maDon_san($id, $maDon){
        $conn = open_database();
        $sql = "update tamgiohangsan set maDon = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $maDon, $id);
        if(!$stmt->execute()){
            return array('code' =>1,'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Success update maDon for San');
    }

    function update_maDon_drink($id, $maDon){
        $conn = open_database();
        $sql = "update tamgiohangdrink set maDon = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $maDon, $id);
        if(!$stmt->execute()){
            return array('code' =>1,'message' =>'cannot execute command');
        }
        return array('code'=>0, 'message'=>'Success update maDon for San');
    }

    function get_all_account_nhanvien(){
        $conn = open_database();
        $sql = "select * from nhanvien";
        $stmt = $conn->prepare($sql);
        
        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'cannot execute command');
        }
        $result = $stmt->get_result();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'Chưa có nhân viên nào');
        }
        $data = array();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return array('code'=>0, 'message'=>'', 'data' => $data);
    }
?>
