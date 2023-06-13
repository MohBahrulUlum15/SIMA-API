<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$kode_barang        = $_POST['kode_barang'];
$merk_genset         = $_POST['merk_genset'];
$kapasitas        = $_POST['kapasitas'];
$kondisi        = $_POST['kondisi'];
$tipe            = $_POST['tipe'];
$id_user            = $_POST['id_user'];
$tanggal            = $_POST['tanggal'];

if (
    $kode_barang == "" || $merk_genset == "" || $kapasitas == "" || $tipe == ""
    || $kondisi == ""  || $tipe == "" || $id_user == "" || $tanggal==""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_spek_genset 
    (kode_barang, merk_genset, kapasitas, kondisi, tipe, id_user, tanggal) VALUES 
    ('$kode_barang', '$merk_genset', '$kapasitas', '$kondisi', '$tipe', '$id_user', '$tanggal')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'kode_barang' =>  $kode_barang,
                'merk_genset' => $merk_genset,
                'kapasitas' => $kapasitas,
                'kondisi' => $kondisi,
                'tipe' => $tipe,
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
