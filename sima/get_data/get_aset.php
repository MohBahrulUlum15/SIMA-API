<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Memeriksa kecocokan data dengan database
$sql = "SELECT * FROM tb_aset";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $barang = array(
            'kode_barang' => $row['kode_barang'],
            'nama_barang' => $row['nama_barang'],
            'merk' => $row['merk'],
            'harga' => $row['harga'],
            'jangka_penggunaan' => $row['jangka_penggunaan'],
            'tanggal_masuk' => $row['tanggal_masuk'],
            'penanggung_jawab' => $row['penanggung_jawab'],
            'kondisi' => $row['kondisi'],
            'nama_gambar' => $row['nama_gambar']
        );
        array_push($data, $barang);
    }
    $response = $data;
    echo json_encode($response);
} else {
    echo json_encode(array(
        'success'   => false,
        'message'   => 'Gagal mengambil data!'
    ));
}
