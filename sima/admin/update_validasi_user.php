<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Menerima data dari permintaan POST
$id_user = $_POST['id_user'];
$validasi = $_POST['validasi'];

if (
    $id_user == "" || $validasi == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    // Perbarui data pengguna
    $sql = "UPDATE `tb_user` SET `validasi` = '$validasi' WHERE `tb_user`.`id_user` = '$id_user';";
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil validasi Pendaftar!',
            'success'   => true
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal validasi Pendaftar!',
            'success'   => false
        ));
    }
}
