<?php 
   require '../connection.php';
   header("Content-Type:application/json");

   $Response = array();

   if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (isset($_POST['KodeHIS']) AND isset($_POST['NIP']) AND isset($_POST['NIS']) AND isset($_POST['KodeTP']) AND isset($_POST['TanggalKejadian']) AND isset($_POST['Pukul'])) {

         $KodeHIS = $_POST['KodeHIS'];
         $NIP = $_POST['NIP'];
         $NIS = $_POST['NIS'];
         $KodeTP = $_POST['KodeTP'];
         $Location = $_FILES['BuktiPelanggaran']['tmp_name'];
         $NameIMG = strtolower($_FILES['BuktiPelanggaran']['name']);
         $UploadTO = "../../assets/images/bukti-pelanggaran/";
         $TanggalKejadian = $_POST['TanggalKejadian'];
         $Pukul = $_POST['Pukul'];

         $RandomName = uniqid();
         $RandomName .= "-";
         $RandomName .= $NameIMG;

         move_uploaded_file($Location, $UploadTO.$RandomName);
         
         $Response["status"] = [
            "code" => 200,
            "description" => "Berhasil menambah data pelanggaran"
         ];

         $Insert = "INSERT INTO histori_pelanggaran (
            KodeHIS,
            NIP,
            NIS,
            KodeTP,
            BuktiPelanggaran,
            TanggalKejadian,
            Pukul
         )
         VALUES (
            '$KodeHIS',
            '$NIP',
            '$NIS',
            '$KodeTP',
            '$RandomName',
            '$TanggalKejadian',
            '$Pukul'
         )";

         mysqli_query($CONN, $Insert);

         $Response["results"] = [
            "KodeHIS" => $KodeHIS,
            "NIP" => $NIP,
            "NIS" => $NIS,
            "KodeTP" => $KodeTP,
            "BuktiPelanggaran" => $RandomName,
            "TanggalKejadian" => $TanggalKejadian,
            "Pukul" => $Pukul
         ];
      }
      else {
         $Response["status"] = [
            "code" => 400,
            "description" => "Parameter invalid"
         ];
      }
   }
   else {
      $Response["status"] = [
         "code" => 400,
         "description" => "Metode pengiriman tidak valid"
      ];
   }

   echo json_encode($Response);
?>