<?php

header('access-controll-allow-origin: *');
header('content-type: application/json');

include_once "../dbcon.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $data = array(
        "code" => 401,
        "msg" => 'Worng request method'
    );
    echo json_encode($data);
    die();
}

try {

    $input = json_decode(file_get_contents('php://input'));

    $accId = $input->acc_id;
    $tbId = $input->tb_id;

    $sql = "INSERT INTO orderr (acc_id, tb_id) VALUES ($accId, $tbId)";

    $query1 = mysqli_query($con, $sql);
    if ($query1) {
        $orderId = mysqli_fetch_assoc(mysqli_query($con, "SELECT order_id from orderr order by desc"));
        $sql = "INSERT INTO order_detail ()";
    } else {
        $data = array(
            "code" => 400,
            "msg" => 'Have somg thing error'
        );
    }

    echo json_encode($data);
    die();
} catch (error) {
    $data = array(
        "code" => 400,
        "msg" => 'Have somg thing error'
    );
    echo json_encode($data);
    die();
}
