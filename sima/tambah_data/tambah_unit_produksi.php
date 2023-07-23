<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$tanggal            = $_POST['tanggal'];
$id_user            = $_POST['id_user'];
$uraian_kegiatan    = $_POST['uraian_kegiatan'];
$daya_listrik       = $_POST['daya_listrik'];
// $nama_gambar        = $_POST['nama_gambar'];

$location = $_FILES['nama_gambar']['tmp_name'];
$nameImage = strtolower($_FILES['nama_gambar']['name']);
$uploadTo = "../../uploads/produksi/";

$randomName = uniqid();
$randomName .= "-";
$randomName .= $nameImage;

move_uploaded_file($location, $uploadTo . $randomName);

$sql_check = "SELECT * FROM tb_unit_produksi WHERE id_user='$id_user' AND tanggal='$tanggal'";

$result_check = $conn->query($sql_check);

if (
    $tanggal == "" || $daya_listrik == "" || $id_user == ""
    || $uraian_kegiatan == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else if ($result_check->num_rows > 0) {
    $data_unit_produksi = array();
    while ($row = $result_check->fetch_assoc()) {
        $data_unit_produksi[] = $row;
    }
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Data Unit Produksi ditanggal ini sudah ada!" . $tanggal,
        'data'      => $data_unit_produksi[0]
    ));
} else {
    $sql = "INSERT INTO tb_unit_produksi 
    (tanggal, daya_listrik, id_user, uraian_kegiatan, nama_gambar) VALUES 
    ('$tanggal', '$daya_listrik', '$id_user', '$uraian_kegiatan', '$randomName')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'tanggal' => $tanggal,
                'daya_listrik' =>  $daya_listrik,
                'id_user' => $id_user,
                'uraian_kegiatan' => $uraian_kegiatan,
                'nama_gambar' => $randomName,
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
