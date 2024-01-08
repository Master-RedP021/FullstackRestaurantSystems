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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    if (isset($_FILES['img']['name'])) {
        $dir = "../img/";
        $filename = basename($_FILES['img']['name']);
        $path = $dir . $filename;

        if (move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
            $sql = "UPDATE account
            SET acc_username = '$username',
            acc_password = '$password',
            acc_name = '$name',
            acc_lname = '$lname',
            acc_address = '$address',
            acc_phone = '$phone',
            acc_img = 'http://localhost/api/restaurantSystems/img/$filename'
            where acc_id = $_POST[id]";
        }
        
    } else {
            $sql = "UPDATE account
            SET acc_username = '$username',
            acc_password = '$password',
            acc_name = '$name',
            acc_lname = '$lname',
            acc_address = '$address',
            acc_phone = '$phone'
            where acc_id = $_POST[id]";
    }

    $query = mysqli_query($con, $sql);
    if ($query) {
        $data = array(
            "code" => 201,
            "msg" => 'Update user success'
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