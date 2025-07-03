<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BMI Calculator - RiskObesity</title>
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
    <div class="form-card">

        <div class="bmi-header">
            <img src="../assets/img/bmi.png" alt="BMI Calculator Icon">
            <div>
                <h1>BMI Calculator</h1>
                <p>Body Mass Index</p>
            </div>
        </div>

        <form action="proses_bmi.php" method="post">
            <label for="usia">Usia</label>
            <input type="number" id="usia" name="usia" placeholder="Contoh: 25" min="1" required>

            <label for="gender">Jenis Kelamin</label>
            <select id="gender" name="gender" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Male">Laki-laki</option>
                <option value="Female">Perempuan</option>
            </select>

            <label for="tinggi">Tinggi Badan (cm)</label>
            <input type="number" id="tinggi" name="tinggi" placeholder="Contoh: 175" min="50" required>

            <label for="berat">Berat Badan (kg)</label>
            <input type="number" id="berat" name="berat" placeholder="Contoh: 80" min="1" required>

            <button type="submit" class="btn">Calculate</button>
        </form>

    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 RiskObesity — Syahrina</p>
</footer>

</body>
</html>
