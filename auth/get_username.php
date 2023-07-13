<?php

include('../config.php');

header('Content-Type:application/json;charset=UTF-8');

$username = $_POST['username'];

// Memeriksa kecocokan data dengan database
$sql = "SELECT * FROM tb_user WHERE username = '$username'";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Mengambil baris pertama dari hasil query
    $row = $result->fetch_assoc();
    
    // Mengambil id_user dari baris yang ditemukan
    $id_user = $row['id_user'];

    echo json_encode(array(
        'success'   => true,
        'message'   => 'Berhasil mengambil data!',
        'id_user'   => $id_user
    ));
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Username tidak terdaftar!',
        'id_user'   => ''
    ));
}
