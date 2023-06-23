<?php
include('../config.php');

header('Content-Type:application/json;charset=UTF-8');

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql_check_username = "SELECT * FROM tb_user WHERE username = '$username'";
$result_chek_username = $conn->query($sql_check_username);

if ($result_chek_username->num_rows > 0) {

    // Memeriksa kecocokan data dengan database
    $sql = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' AND validasi = 'diterima'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = array();
        while ($row = $result->fetch_assoc()) {
            $user[] = $row;
        }
        echo json_encode(array(
            'success'   => true,
            'message'   => 'Login Berhasil',
            'data'      => $user[0]
        ));
    } else {
        echo json_encode(array(
            'success'   => false,
            'message'   => 'Login gagal!'
        ));
    }
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'username tidak terdaftar!'
    ));
}
