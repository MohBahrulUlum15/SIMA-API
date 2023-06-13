<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

$tanggal            = $_POST['tanggal'];
$beban_puncak    = $_POST['beban_puncak'];
$luar_beban_puncak       = $_POST['luar_beban_puncak'];
$penggunaan_daya_reaktif        = $_POST['penggunaan_daya_reaktif'];
$standmeter        = $_POST['standmeter'];
$id_user            = $_POST['id_user'];
$nama_karyawan_dua            = $_POST['nama_karyawan_dua'];

$sql_check = "SELECT * FROM tb_laporan_harian WHERE id_user='$id_user' AND tanggal='$tanggal'";

$result_check = $conn->query($sql_check);

if (
    $tanggal == "" || $beban_puncak == "" || $luar_beban_puncak == ""
    || $penggunaan_daya_reaktif == "" || $standmeter == ""
    || $id_user == "" || $nama_karyawan_dua == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else if ($result_check->num_rows > 0) {
    $data_laporan_harian = array();
    while ($row = $result_check->fetch_assoc()) {
        $data_laporan_harian[] = $row;
    }
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Data Laporan Harian ditanggal ini sudah ada!" . $tanggal,
        'data'      => $data_laporan_harian[0]
    ));
} else {
    $sql = "INSERT INTO tb_laporan_harian (kode_laporan, tanggal, beban_puncak, luar_beban_puncak, penggunaan_daya_reaktif, standmeter, id_user, nama_karyawan_dua) 
    VALUES (NULL, '$tanggal', '$beban_puncak', '$luar_beban_puncak', '$penggunaan_daya_reaktif', '$standmeter', '$id_user', '$nama_karyawan_dua');";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Berhasil tambah data',
            'success'   => true,
            'data'      => array(
                'tanggal' => $tanggal,
                'beban_puncak' => $beban_puncak,
                'luar_beban_puncak' =>  $luar_beban_puncak,
                'penggunaan_daya_reaktif' => $penggunaan_daya_reaktif,
                'standmeter' => $standmeter,
                'id_user' => $id_user,
                'nama_karyawan_dua' => $nama_karyawan_dua,
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal tambah data!',
            'success'   => false
        ));
    }
}
