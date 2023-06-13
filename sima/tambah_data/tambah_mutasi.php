<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$tanggal            = $_POST['tanggal'];
$kode_barang        = $_POST['kode_barang'];
$lokasi_awal        = $_POST['lokasi_awal'];
$spesifikasi        = $_POST['spesifikasi'];
$nama_gambar        = $_POST['nama_gambar'];
$lokasi_akhir       = $_POST['lokasi_akhir'];
$id_user            = $_POST['id_user'];
$quality_control    = $_POST['quality_control'];

if (
    $tanggal == "" || $kode_barang == "" || $lokasi_awal == ""
    || $spesifikasi == "" || $nama_gambar == "" || $lokasi_akhir == ""
    || $id_user == "" || $quality_control == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_mutasi 
    (tanggal, kode_barang, lokasi_awal, spesifikasi, nama_gambar, lokasi_akhir, id_user, quality_control) VALUES 
    ('$tanggal', '$kode_barang', '$lokasi_awal', '$spesifikasi', '$nama_gambar', '$lokasi_akhir', '$id_user', '$quality_control')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'tanggal' => $tanggal,
                'kode_barang' =>  $kode_barang,
                'lokasi_awal' => $lokasi_awal,
                'spesifikasi' => $spesifikasi,
                'nama_gambar' => $nama_gambar,
                'lokasi_akhir' => $lokasi_akhir,
                'id_user' => $id_user,
                'quality_control' => $quality_control
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
