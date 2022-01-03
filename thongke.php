<?php 
    require_once("db.php");
    require("carbon/autoload.php");
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    if(isset($_POST['thoigian'])){
        $thoigian = $_POST['thoigian'];
    }else{
        $thoigian = '';
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    if($thoigian=='7ngay'){
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    }else if($thoigian=='30ngay'){
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
    }else if($thoigian=='90ngay'){
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
    }else{
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $conn = open_database();
    $sql = "SELECT * FROM doanhthu WHERE date BETWEEN ? AND ? ORDER BY date ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $subday, $now);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    while ($row = $result->fetch_assoc()){
        $data[] = array(
            'date' => $row['date'],
            'doanhthu' => $row['doanhthu'],
            'sodon' => $row['sodon']
        );
    }
    echo $dataChart = json_encode($data);
?>