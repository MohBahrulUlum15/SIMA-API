<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$kode_barang           = $_POST['kode_barang'];
$nama_barang           = $_POST['nama_barang'];
$merk                   = $_POST['merk'];
$harga                  = $_POST['harga'];
$jangka_penggunaan         = $_POST['jangka_penggunaan'];
$tanggal_masuk          = $_POST['tanggal_masuk'];
$penanggung_jawab        = $_POST['penanggung_jawab'];
$kondisi                  = $_POST['kondisi'];

// $nama_gambar           = $_POST['nama_gambar'];

$location = $_FILES['nama_gambar']['tmp_name'];
$nameImage = strtolower($_FILES['nama_gambar']['name']);
$uploadTo = "../../uploads/aset/";

$randomName = uniqid();
$randomName .= "-";
$randomName .= $nameImage;

move_uploaded_file($location, $uploadTo . $randomName);

if (
    $kode_barang == "" || $nama_barang == "" || $merk == "" || $harga == ""
    || $jangka_penggunaan == "" || $tanggal_masuk == "" || $penanggung_jawab == ""
    || $kondisi == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_aset (
        kode_barang, 
        nama_barang, 
        merk, harga, 
        jangka_penggunaan, 
        tanggal_masuk, 
        penanggung_jawab, 
        kondisi, 
        nama_gambar
    ) 
    VALUES (
        '$kode_barang',
        '$nama_barang', 
        '$merk', 
        '$harga', 
        '$jangka_penggunaan', 
        '$tanggal_masuk', 
        '$penanggung_jawab', 
        '$kondisi', 
        '$randomName')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'kode_barang' => $kode_barang,
                'nama_barang' => $nama_barang,
                'merk' =>  $merk,
                'harga' => $harga,
                'jangka_penggunaan' => $jangka_penggunaan,
                'tanggal_masuk' => $tanggal_masuk,
                'penanggung_jawab' => $penanggung_jawab,
                'kondisi' => $kondisi,
                'nama_gambar' => $randomName
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
