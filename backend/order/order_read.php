<?php

include "../dbcon.php";
header('access-control-allow-origin: *');
header('access-control-allow-headers: *');
header("content-type: application/json");

if (file_get_contents('php://input')) {
    $input = json_decode(file_get_contents('php://input'));

    $value = array();
    
    foreach($input->id as $id) {        
        $sql = "SELECT * from restable where tb_id = $id";
        $query = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($query);

        $value[] = $data;
    }

} else {
    $sql = "SELECT * from restable";
    $query = mysqli_query($con, $sql);
    $value = mysqli_fetch_all($query, MYSQLI_ASSOC);
}

echo json_encode($value);
