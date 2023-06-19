<?php

include('../../config.php');

header('Content-Type:application/json;charset=UTF-8');

// Mendapatkan input bulan dari permintaan
$bulan = $_GET['bulan'];

// Query untuk mengambil data pada tanggal awal bulan
$queryAwalBulan = "SELECT tb_laporan_harian.tanggal, tb_laporan_harian.beban_puncak, 
tb_laporan_harian.luar_beban_puncak, tb_laporan_harian.penggunaan_daya_reaktif, 
tb_laporan_harian.standmeter, tb_user.nama_lengkap 
FROM tb_laporan_harian 
JOIN tb_user ON tb_laporan_harian.id_user = tb_user.id_user
WHERE DATE_FORMAT(tb_laporan_harian.tanggal, '%d') = '01' 
AND DATE_FORMAT(tb_laporan_harian.tanggal, '%M') = '$bulan';";

$resultAwalBulan = $conn->query($queryAwalBulan);

// Query untuk mengambil data pada tanggal akhir bulan
$queryAkhirBulan = "SELECT tb_laporan_harian.tanggal, tb_laporan_harian.beban_puncak, 
tb_laporan_harian.luar_beban_puncak, tb_laporan_harian.penggunaan_daya_reaktif, 
tb_laporan_harian.standmeter, tb_user.nama_lengkap 
FROM tb_laporan_harian 
JOIN tb_user ON tb_laporan_harian.id_user = tb_user.id_user
WHERE DATE_FORMAT(tb_laporan_harian.tanggal, '%d') = DAY(LAST_DAY(tb_laporan_harian.tanggal))
AND DATE_FORMAT(tb_laporan_harian.tanggal, '%M') = '$bulan';";

$resultAkhirBulan = $conn->query($queryAkhirBulan);

// Cek apakah terdapat data pada tanggal awal bulan
if ($resultAwalBulan->num_rows > 0) {
    $dataAwalBulan = array();
    while ($row = $resultAwalBulan->fetch_assoc()) {
        $dataAwalBulan[] = $row;
    }

    // Cek apakah terdapat data pada tanggal akhir bulan
    if ($resultAkhirBulan->num_rows > 0) {
        $dataAkhirBulan = array();
        while ($row = $resultAkhirBulan->fetch_assoc()) {
            $dataAkhirBulan[] = $row;
        }

        // Menggabungkan data awal bulan dan akhir bulan dalam satu array
        $resultArray = array(
            'dataAwalBulan' => $dataAwalBulan,
            'dataAkhirBulan' => $dataAkhirBulan
        );

        // Mengubah array menjadi JSON
        $jsonResult = json_encode(array(
            'success'   => true,
            'msg'       => "Berhasil",
            'data'      =>  $resultArray   
        ));
        echo $jsonResult;
    } else {
        echo json_encode(array(
            'success'   => false,
            'msg'   => 'laporan di bulan tersebut belum tersedia'
        ));
    }
} else {
    echo json_encode(array(
        'success'   => false,
        'msg'   => 'laporan di bulan tersebut belum tersedia'
    ));
}