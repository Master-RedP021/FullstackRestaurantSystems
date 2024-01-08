<?php

header('access-controll-allow-origin: *');
header('access-controll-allow-methods: *');
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
    $status = $_POST['status'];
    $people = $_POST['people'];

    $sql = "UPDATE restable
    SET tb_status = '$status',
    tb_people = '$people'
    where td_id = $_POST[id]";

    $query = mysqli_query($con, $sql);
    if ($query) {
        $data = array(
            "code" => 201,
            "msg" => 'Update table info conplete'
        );
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