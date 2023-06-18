<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_aset.kode_barang, tb_aset.nama_barang, tb_spek_genset.merk_genset, tb_spek_genset.kapasitas, tb_spek_genset.kondisi, tb_spek_genset.tipe, tb_spek_genset.tanggal, tb_user.nama_lengkap 
FROM tb_spek_genset
JOIN tb_aset ON tb_spek_genset.kode_barang = tb_aset.kode_barang 
JOIN tb_user ON tb_spek_genset.id_user = tb_user.id_user;";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $spek_genset = $row;
        array_push($data, $spek_genset);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}