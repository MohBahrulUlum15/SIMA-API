<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$kode_barang        = $_POST['kode_barang'];
$konfigurasi         = $_POST['konfigurasi'];
$star_delta        = $_POST['star_delta'];
$direct_online        = $_POST['direct_online'];
$kapasitas_beban        = $_POST['kapasitas_beban'];
$id_user            = $_POST['id_user'];
$tanggal            = $_POST['tanggal'];

if (
    $kode_barang == "" || $konfigurasi == "" || $star_delta == "" || $id_user == ""
    || $direct_online == "" || $kapasitas_beban == "" || $id_user == "" || $tanggal == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_spek_panel 
    (kode_barang, konfigurasi, star_delta, direct_online, kapasitas_beban, id_user, tanggal) VALUES 
    ('$kode_barang', '$konfigurasi', '$star_delta', '$direct_online', '$kapasitas_beban', '$id_user', '$tanggal')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'kode_barang' =>  $kode_barang,
                'konfigurasi' => $konfigurasi,
                'star_delta' => $star_delta,
                'direct_online' => $direct_online,
                'kapasitas_beban' => $kapasitas_beban,
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
