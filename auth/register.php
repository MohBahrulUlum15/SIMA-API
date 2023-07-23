<?php

include('../config.php');

header('Content-Type:application/json;charset=UTF-8');

$nama_lengkap           = $_POST['nama_lengkap'];
$tempat_lahir           = $_POST['tempat_lahir'];
$tanggal_lahir          = $_POST['tanggal_lahir'];
$alamat_lengkap         = $_POST['alamat_lengkap'];
$jenis_kelamin          = $_POST['jenis_kelamin'];
$kewarganegaraan        = $_POST['kewarganegaraan'];
$agama                  = $_POST['agama'];
$no_handphone           = $_POST['no_handphone'];
$pendidikan_terakhir    = $_POST['pendidikan_terakhir'];
$jabatan                = $_POST['jabatan'];
$departemen             = $_POST['departemen'];
$username               = $_POST['username'];
$password               = md5($_POST['password']);
$validasi               = $_POST['validasi'];


$sql_check = "SELECT * FROM tb_user WHERE username = '$username'";

$result_check = $conn->query($sql_check);

if (
    $nama_lengkap == "" || $tempat_lahir == "" || $tanggal_lahir == ""
    || $alamat_lengkap == "" || $jenis_kelamin == "" || $kewarganegaraan == ""
    || $agama == "" || $no_handphone == "" || $pendidikan_terakhir == ""
    || $jabatan == "" || $departemen == "" || $username == "" || $password == ""
) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Field tidak diisi!"
    ));
} else if ($result_check->num_rows > 0) {
    echo json_encode(array(
        'success' => false,
        "message" => "Gagal! Username sudah terdaftar!"
    ));
} else {
    $sql = "INSERT INTO tb_user 
    (nama_lengkap, tempat_lahir, tanggal_lahir, alamat_lengkap, jenis_kelamin, kewarganegaraan, agama, no_handphone, pendidikan_terakhir, jabatan, departemen, username, password, validasi) VALUES 
    ('$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$alamat_lengkap', '$jenis_kelamin', '$kewarganegaraan', '$agama', '$no_handphone', '$pendidikan_terakhir', '$jabatan', '$departemen', '$username', '$password', '$validasi')";

    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(array(
            'message'   => 'Register Berhasil',
            'success'   => true,
            'data'      => array(
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' =>  $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat_lengkap' => $alamat_lengkap,
                'jenis_kelamin' => $jenis_kelamin,
                'keawrganegaraan' => $kewarganegaraan,
                'agama' => $agama,
                'no_handphone' => $no_handphone,
                'pendidikan_terakhir' => $pendidikan_terakhir,
                'jabatan' => $jabatan,
                'departemen' => $departemen,
                'username' => $username,
                'password' => $password,
                'validasi' => $validasi
            )
        ));
    } else {
        echo json_encode(array(
            'message'   => 'Gagal!',
            'success'   => false
        ));
    }
}
