<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$tanggal            = $_POST['tanggal'];
$kode_barang        = $_POST['kode_barang'];
$id_user            = $_POST['id_user'];
$uraian_kegiatan    = $_POST['uraian_kegiatan'];
$nama_gambar        = $_POST['nama_gambar'];

if (
    $tanggal == "" || $kode_barang == "" || $id_user == ""
    || $uraian_kegiatan == "" || $nama_gambar == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_perawatan 
    (tanggal, kode_barang, id_user, uraian_kegiatan, nama_gambar) VALUES 
    ('$tanggal', '$kode_barang', '$id_user', '$uraian_kegiatan', '$nama_gambar')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'tanggal' => $tanggal,
                'kode_barang' =>  $kode_barang,
                'id_user' => $id_user,
                'uraian_kegiatan' => $uraian_kegiatan,
                'nama_gambar' => $nama_gambar,
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
