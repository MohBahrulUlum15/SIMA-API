<?php

include('../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Menerima data dari permintaan POST
$id_user = $_POST['id_user'];
$password = md5($_POST['password']);

if (
    $id_user == "" || $password == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    // Perbarui data pengguna
    $sql = "UPDATE `tb_user` SET `password` = '$password' WHERE `tb_user`.`id_user` = '$id_user';";
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil megubuah Password!',
            'success'   => true
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal mengubah Password!',
            'success'   => false
        ));
    }
}
