<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config/koneksi.php';

// Ambil data dari form
$usia   = $_POST['usia'];
$gender = $_POST['gender'];
$tinggi = $_POST['tinggi'];
$berat  = $_POST['berat'];

// Hitung BMI
$bmi = $berat / pow(($tinggi / 100), 2);

// Simpan ke tabel data_bmi
$query = "INSERT INTO data_bmi (age, gender, height, weight, bmi) 
          VALUES ('$usia', '$gender', '$tinggi', '$berat', '$bmi')";

if (mysqli_query($koneksi, $query)) {
    // Ambil ID data yang baru saja disimpan
    $id_bmi = mysqli_insert_id($koneksi);

    // Redirect ke proses prediksi
    header("Location: proses_prediksi.php?id=$id_bmi&usia=$usia");
    exit;
} else {
    echo "Gagal menyimpan data BMI!";
}
?>
