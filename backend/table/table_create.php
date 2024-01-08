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
    $people = $_POST['people'];

    $sql = "INSERT INTO restable (tb_people) VALUES ($people)";

    $query = mysqli_query($con, $sql);
    if ($query) {
        $data = array(
            "code" => 201,
            "msg" => 'Add New Table success'
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