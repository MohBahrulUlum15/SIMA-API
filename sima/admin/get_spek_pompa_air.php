<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_aset.kode_barang, tb_aset.nama_barang, tb_spesifikasi_pompa.head_pompa, tb_spesifikasi_pompa.debit_pompa, tb_spesifikasi_pompa.tanggal, tb_user.nama_lengkap 
FROM tb_spesifikasi_pompa
JOIN tb_aset ON tb_spesifikasi_pompa.kode_barang = tb_aset.kode_barang
JOIN tb_user ON tb_spesifikasi_pompa.id_user = tb_user.id_user
WHERE tb_spesifikasi_pompa.jenis_pompa = 'pompa air';";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $spek_pompa_air = $row;
        array_push($data, $spek_pompa_air);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}