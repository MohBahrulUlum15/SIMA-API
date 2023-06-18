<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_aset.kode_barang, tb_aset.nama_barang, tb_mutasi.tanggal, tb_mutasi.lokasi_awal, tb_mutasi.lokasi_akhir, tb_mutasi.spesifikasi, 
tb_mutasi.nama_gambar, tb_mutasi.quality_control, tb_user.nama_lengkap 
FROM tb_mutasi 
JOIN tb_aset ON tb_mutasi.kode_barang = tb_aset.kode_barang 
JOIN tb_user ON tb_mutasi.id_user = tb_user.id_user;";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mutasi = $row;
        array_push($data, $mutasi);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}