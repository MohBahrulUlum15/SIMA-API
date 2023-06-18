<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT tb_laporan_harian.tanggal, tb_laporan_harian.beban_puncak, 
tb_laporan_harian.luar_beban_puncak, tb_laporan_harian.penggunaan_daya_reaktif, 
tb_laporan_harian.standmeter, tb_user.nama_lengkap 
FROM tb_laporan_harian 
JOIN tb_user ON tb_laporan_harian.id_user = tb_user.id_user;";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $laporan = $row;
        array_push($data, $laporan);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}