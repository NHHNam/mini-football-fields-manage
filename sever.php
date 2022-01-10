<?php 
    require_once("db.php");
    $result = get_all_san();
    $data = $result['data'];
    $nameSans = array();
    $keyword = "%{$_GET['word']}%";

    $conn = open_database();
    $sql = "SELECT * FROM sanbong where tenSan LIKE ? or addressSan LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()){
        $nameSans[] = array('tenSan'=>$row['tenSan'], 'maSan' => $row['maSan']);
    }
    $response = array();
    $response['code'] = 0;
    $response['message'] = 'Tìm thấy ' . count($nameSans) . ' kết quả';
    if(empty($_GET['word'])){ 
        $response['data'] = array();
    }else{
        $response['data'] = $nameSans;
    }
    print_r(json_encode($response));
?>