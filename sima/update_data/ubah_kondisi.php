<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Menerima data dari permintaan POST
$kode_barang = $_POST['kode_barang'];
$kondisi = $_POST['kondisi'];
$uraian_kondisi = $_POST['uraian_kondisi'];

if (
    $kode_barang == "" || $kondisi == "" || $uraian_kondisi == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    // Perbarui data kondisi
    $sql = "UPDATE `tb_aset` SET `kondisi` = '$kondisi', `uraian_kondisi` = '$uraian_kondisi' WHERE `tb_aset`.`kode_barang` = '$kode_barang';";
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil mengubah Kondisi!',
            'success'   => true
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal mengubah Kondisi!',
            'success'   => false
        ));
    }
}