<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$kode_barang        = $_POST['kode_barang'];
$daya_listrik         = $_POST['daya_listrik'];
$arus_maks        = $_POST['arus_maks'];
$cos        = $_POST['cos'];
$id_user            = $_POST['id_user'];
$tanggal            = $_POST['tanggal'];

if (
    $kode_barang == "" || $daya_listrik == "" || $arus_maks == "" || $id_user == ""
    || $cos == ""  || $id_user == "" || $tanggal == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_spek_motor_pompa 
    (kode_barang, daya_listrik, arus_maks, cos, id_user, tanggal) VALUES 
    ('$kode_barang', '$daya_listrik', '$arus_maks', '$cos', '$id_user', '$tanggal')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'kode_barang' =>  $kode_barang,
                'daya_listrik' => $daya_listrik,
                'arus_maks' => $arus_maks,
                'cos' => $cos,
                'id_user' => $id_user,
                'tanggal' => $tanggal,
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
