<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id       = isset($_GET['id']) ? $_GET['id'] : '';
$usia     = isset($_GET['usia']) ? $_GET['usia'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Validasi: pastikan ID BMI wajib ada
if (empty($id)) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Risk Check - RiskObesity</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 18px;
      margin-top: 20px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
    }
    .form-group label {
      font-weight: 500;
      margin-bottom: 6px;
    }
    .form-group input[type="number"] {
      padding: 6px 55px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      width: 100px;
    }
    .btn-primary {
      padding: 12px 20px;
      background-color: #2B3467;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 20px;
    }
    .btn-primary:hover {
      background-color: #1e254f;
    }
    .btn-secondary {
      padding: 10px 16px;
      background-color: #BAD7E9;
      color: #333;
      border: none;
      border-radius: 8px;
      margin-top: 12px;
      display: inline-block;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }
    .btn-secondary:hover {
      background-color: #a8cbe0;
    }
  </style>
</head>
<body>

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

<main class="container">
  <div class="card">
    <div class="card-content">
      <h1>Cek Risiko Penyakit Akibat Obesitas</h1>
      <p class="justify">Berikan nilai skala untuk faktor-faktor risiko di bawah ini sesuai kondisi Anda. Skala 1 (sangat rendah) hingga 10 (sangat tinggi).</p>

      <form action="proses_saw.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="usia" value="<?= $usia ?>">
        <input type="hidden" name="kategori" value="<?= $kategori ?>">

        <div class="form-grid">
          <div class="form-group">
            <label>Stres</label>
            <input type="number" name="stres" min="1" max="10" required>
          </div>

          <div class="form-group">
            <label>Kurang Tidur</label>
            <input type="number" name="tidur" min="1" max="10" required>
          </div>

          <div class="form-group">
            <label>Merokok</label>
            <input type="number" name="merokok" min="1" max="10" required>
          </div>

          <div class="form-group">
            <label>Makan Berlebih</label>
            <input type="number" name="makan" min="1" max="10" required>
          </div>

          <div class="form-group">
            <label>Olahraga</label>
            <input type="number" name="olahraga" min="1" max="10" required>
          </div>
        </div>

        <button type="submit" class="btn-primary">Cek Risiko</button>
      </form>

      <a href="dashboard.php" class="btn-secondary">← Kembali ke Dashboard</a>
    </div>

    <div class="card-image">
      <img src="../assets/img/risk_form.png" alt="Risk Check Illustration">
    </div>
  </div>
</main>

<footer class="footer">
  <p>&copy; 2025 RiskObesity — Syahrina</p>
</footer>

</body>
</html>
