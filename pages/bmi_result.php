<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config/koneksi.php';
include '../config/helper.php';

// Ambil ID & usia dari URL
$id   = isset($_GET['id']) ? intval($_GET['id']) : 0;
$usia = isset($_GET['usia']) ? intval($_GET['usia']) : 0;

// Ambil data BMI dari database
$query_bmi = "SELECT * FROM data_bmi WHERE id = $id";
$result_bmi = mysqli_query($koneksi, $query_bmi);
$data_bmi = mysqli_fetch_assoc($result_bmi);

// Jika data BMI tidak ditemukan
if (!$data_bmi) {
    echo "Data BMI tidak ditemukan!";
    exit;
}

// Ambil hasil prediksi kategori dari tabel hasil_prediksi
$query_prediksi = "SELECT prediksi_kategori FROM hasil_prediksi WHERE id_bmi = $id";
$result_prediksi = mysqli_query($koneksi, $query_prediksi);
$data_prediksi = mysqli_fetch_assoc($result_prediksi);

// Jika hasil prediksi belum tersedia
$kategori = $data_prediksi ? $data_prediksi['prediksi_kategori'] : 'Belum Diprediksi';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BMI Result - RiskObesity</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="logo">
        <img src="../assets/img/riskobesity.png" alt="RiskObesity Logo">
        <span>Risk<span style="color:#BAD7E9;">Obesity</span></span>
    </div>
    <nav class="nav">
        <a href="dashboard.php">Home</a>
        <a href="about.php">About</a>
    </nav>
</header>

<!-- Main Content -->
<main class="container">
  <div class="bmi-result-card">
    <div class="bmi-result-content">
      <h1>Hasil BMI Anda</h1>
      <p class="justify">Berikut hasil perhitungan dan klasifikasi BMI Anda berdasarkan data yang telah dimasukkan:</p>

      <div class="result-detail">
        <p><strong>ID BMI:</strong> <?= formatIdBmi($data_bmi['id']); ?></p>
        <p><strong>Usia:</strong> <?= htmlspecialchars($data_bmi['age']); ?> tahun</p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($data_bmi['gender']); ?></p>
        <p><strong>Berat Badan:</strong> <?= htmlspecialchars($data_bmi['weight']); ?> kg</p>
        <p><strong>Tinggi Badan:</strong> <?= htmlspecialchars($data_bmi['height']); ?> cm</p>
        <p><strong>BMI:</strong> <?= htmlspecialchars($data_bmi['bmi']); ?></p>
      </div>

      <div class="result-icon">
        <?php if ($kategori == 'Obese I' || $kategori == 'Obese II') : ?>
          <img src="../assets/img/warning.png" alt="Warning Icon">
          <h3 style="color:#E74646;">Kategori: <?= htmlspecialchars($kategori); ?></h3>
          <p>Segera lakukan pengecekan risiko penyakit obesitas sesuai kategori ini!</p>
          <a href="risk_check.php?id=<?= urlencode($id) ?>&usia=<?= urlencode($usia) ?>&kategori=<?= urlencode($kategori) ?>" class="btn">Check Risiko</a>

        <?php elseif ($kategori == 'Belum Diprediksi') : ?>
          <img src="../assets/img/question.png" alt="Unknown Icon">
          <h3 style="color:#555;">Kategori: Belum Diprediksi</h3>
          <p>Hasil kategori BMI Anda belum tersedia. Silakan tunggu proses prediksi dilakukan.</p>
          <a href="bmi.php" class="btn">Kembali</a>

        <?php else : ?>
          <img src="../assets/img/safe.png" alt="Safe Icon">
          <h3 style="color:#3AB34A;">Kategori: <?= htmlspecialchars($kategori); ?></h3>
          <p>Kategori ini tidak memerlukan pengecekan risiko. Tetap pertahankan gaya hidup sehat!</p>
          <a href="bmi.php" class="btn">Cek Ulang BMI</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 RiskObesity — Syahrina</p>
</footer>

</body>
</html>
