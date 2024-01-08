<?php

include "../dbcon.php";

header('access-control-allow-origin: *');
header('access-control-allow-headers: *');
header('content-type: application/json');

$input = json_decode(file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] != 'DELETE'){
    echo json_encode(array(
        "code" => 400,
        "msg" => 'Worng request method'
    ));
    die();
}

$id = $input->id;

$sql = "DELETE from table where tb_id = $id";
if (mysqli_query($con, $sql)) {
    echo json_encode(array(
        "code" => 201,
        "msg" => 'Remove Table success'
    ));
} else {
    echo json_encode(array(
        "code" => 400,
        "msg" => 'Have somgthing error'
    ));
}