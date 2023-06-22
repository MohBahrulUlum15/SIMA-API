<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT * FROM `tb_user` WHERE validasi = 'diproses';";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $karyawan = $row;
        array_push($data, $karyawan);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}
