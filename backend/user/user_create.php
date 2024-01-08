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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    if (basename($_FILES['img']['name'])) {
        $dir = "../img/";
        $filename = basename($_FILES['img']['name']);
        $path = $dir . $filename;

        if (move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
            $sql = "INSERT INTO account (acc_username, acc_password, acc_name, acc_lname, acc_address, acc_phone, acc_img)
            VALUES ('$username', '$password', '$name', '$lname', '$address', '$phone', 'http://localhost/api/restaurantSystems/img/$filename')";
        }
        
    } else {
        $sql = "INSERT INTO account (acc_username, acc_password, acc_name, acc_lname, acc_address, acc_phone)
        VALUES ('$username', '$password', '$name', '$lname', '$address', '$phone')";
    }

    $query = mysqli_query($con, $sql);
    if ($query) {
        $data = array(
            "code" => 201,
            "msg" => 'Create user success'
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