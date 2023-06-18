<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_aset.kode_barang, tb_aset.nama_barang, tb_spek_panel.star_delta, 
tb_spek_panel.direct_online, tb_spek_panel.kapasitas_beban, tb_spek_panel.tanggal, tb_user.nama_lengkap 
FROM tb_spek_panel 
JOIN tb_aset ON tb_spek_panel.kode_barang = tb_aset.kode_barang 
JOIN tb_user ON tb_spek_panel.id_user = tb_user.id_user;";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $spek_panel = $row;
        array_push($data, $spek_panel);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}