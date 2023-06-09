<?php

include('../config.php');

header('Content-Type:application/json;charset=UTF-8');

$nama_barang           = $_POST['nama_barang'];
$merk           = $_POST['merk'];
$harga          = $_POST['harga'];
$jangka_penggunaan         = $_POST['jangka_penggunaan'];
$tanggal_masuk          = $_POST['tanggal_masuk'];
$penanggung_jawab        = $_POST['penanggung_jawab'];
$kondisi                  = $_POST['kondisi'];
$nama_gambar           = $_POST['nama_gambar'];

if (
    $nama_barang == "" || $merk == "" || $harga == ""
    || $jangka_penggunaan == "" || $tanggal_masuk == "" || $penanggung_jawab == ""
    || $kondisi == "" || $nama_gambar == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_aset 
    (nama_barang, merk, harga, jangka_penggunaan, tanggal_masuk, penanggung_jawab, kondisi, nama_gambar) VALUES 
    ('$nama_barang', '$merk', '$harga', '$jangka_penggunaan', '$tanggal_masuk', '$penanggung_jawab', '$kondisi', '$nama_gambar')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'nama_barang' => $nama_barang,
                'merk' =>  $merk,
                'harga' => $harga,
                'jangka_penggunaan' => $jangka_penggunaan,
                'tanggal_masuk' => $tanggal_masuk,
                'penanggung_jawab' => $penanggung_jawab,
                'kondisi' => $kondisi,
                'nama_gambar' => $nama_gambar
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
