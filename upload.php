<?php

include('config.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $uploadPath = "uploads/";
    $file = $uploadPath . uniqid() . '.jpg';

    if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {

        $query = "INSERT INTO tb_gambar (name, image, created_at) VALUES ('$name', '$file', NOW())";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Gambar berhasil diunggah.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Terjadi kesalahan saat mengunggah gambar.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Terjadi kesalahan saat menyimpan gambar.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Metode permintaan tidak valid.';
}

echo json_encode($response);
?>