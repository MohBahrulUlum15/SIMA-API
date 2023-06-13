<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$tanggal            = $_POST['tanggal'];
$kode_barang        = $_POST['kode_barang'];
$head_pompa         = $_POST['head_pompa'];
$debit_pompa        = $_POST['debit_pompa'];
$id_user            = $_POST['id_user'];
$jenis_pompa        = $_POST['jenis_pompa'];

if (
    $tanggal == "" || $kode_barang == "" || $head_pompa == "" || $debit_pompa == "" || $id_user == "" || $tanggal == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else {
    $sql = "INSERT INTO tb_spesifikasi_pompa 
    (kode_barang, head_pompa, debit_pompa, id_user, tanggal, tanggal) VALUES 
    ('$kode_barang', '$head_pompa', '$debit_pompa', '$id_user', '$tanggal', '$tanggal')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'kode_barang' =>  $kode_barang,
                'head_pompa' => $head_pompa,
                'debit_pompa' => $debit_pompa,
                'id_user' => $id_user,
                'tanggal' => $tanggal,
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
