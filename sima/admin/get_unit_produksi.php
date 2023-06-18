<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_unit_produksi.tanggal, tb_unit_produksi.uraian_kegiatan, tb_unit_produksi.daya_listrik, 
tb_unit_produksi.nama_gambar, tb_user.nama_lengkap 
FROM tb_unit_produksi 
JOIN tb_user ON tb_unit_produksi.id_user = tb_user.id_user;";
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
