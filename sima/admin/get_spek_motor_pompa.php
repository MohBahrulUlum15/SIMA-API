<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_aset.kode_barang, tb_aset.nama_barang, tb_spek_motor_pompa.daya_listrik, tb_spek_motor_pompa.arus_maks, 
tb_spek_motor_pompa.cos AS cos_value, tb_spek_motor_pompa.tanggal, tb_user.nama_lengkap FROM tb_spek_motor_pompa 
JOIN tb_aset ON tb_spek_motor_pompa.kode_barang = tb_aset.kode_barang 
JOIN tb_user ON tb_spek_motor_pompa.id_user = tb_user.id_user;";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $spek_motor_pompa = $row;
        array_push($data, $spek_motor_pompa);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}