<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config/koneksi.php';

// ambil id dan usia
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$usia = isset($_GET['usia']) ? intval($_GET['usia']) : 0;

// ambil data bmi
$query = "SELECT * FROM data_bmi WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// cek kalau data ketemu
if ($data) {
    // Prediksi kategori (contoh sederhananya, kamu bisa sesuaikan dengan Naive Bayes beneran)
    $bmi = $data['bmi'];
    if ($bmi < 18.5) {
        $kategori = 'Underweight';
    } elseif ($bmi >= 18.5 && $bmi < 25) {
        $kategori = 'Normal';
    } elseif ($bmi >= 25 && $bmi < 30) {
        $kategori = 'Overweight';
    } elseif ($bmi >= 30 && $bmi < 35) {
        $kategori = 'Obese I';
    } else {
        $kategori = 'Obese II';
    }

    // Simpan ke hasil_prediksi
    $insert_prediksi = "INSERT INTO hasil_prediksi (id_bmi, prediksi_kategori) VALUES ('$id', '$kategori')";
    mysqli_query($koneksi, $insert_prediksi);
}

// setelah prediksi selesai → redirect ke hasil
header("Location: bmi_result.php?id=$id&usia=$usia");
exit;
?>
