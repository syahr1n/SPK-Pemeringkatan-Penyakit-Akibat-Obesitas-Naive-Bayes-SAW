<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About - RiskObesity</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-image">
            <img src="../assets/img/obese.png" alt="About Illustration">
        </div>
        <div class="about-text">
            <h1>SPK Pemeringkatan Risiko Akibat Penyakit Obesitas</h1>
            <p>Sistem pendukung keputusan ini memadukan <strong>Naive Bayes</strong> untuk klasifikasi status BMI dan <strong>SAW</strong> untuk pemeringkatan risiko penyakit obesitas berdasarkan gaya hidup.</p>
        </div>
    </section>

    <!-- Section: Kriteria Gaya Hidup -->
    <section>
    <div class="section-title-wrapper">
        <h2 class="section-title">Kriteria Gaya Hidup</h2>
    </div>
    <div class="cards-grid">
        <div class="info-card">
            <h3>Stress</h3>
            <img src="../assets/img/stress.jpg" alt="Stress Icon">
            <p>Stress memengaruhi hormon dan perilaku yang dapat memicu kenaikan berat badan.</p>
        </div>
        <div class="info-card">
            <h3>Olahraga</h3>
            <img src="../assets/img/olahraga.jpg" alt="Olahraga Icon">
            <p>Aktivitas fisik meningkatkan metabolisme dan membakar kalori berlebih.</p>
            </div>
        <div class="info-card"> 
            <h3>Makan Berlebih</h3>
            <img src="../assets/img/makan.jpg" alt="Makan Berlebih Icon">
            <p>Kelebihan kalori tanpa aktivitas cukup menyebabkan akumulasi lemak.</p>
        </div>
        <div class="info-card">
            <h3>Merokok</h3>
            <img src="../assets/img/merokok.jpg" alt="Merokok Icon">
            <p>Perokok berat rentan obesitas karena gangguan metabolisme dan nafsu makan.</p>
        </div>
        <div class="info-card">
            <h3>Kurang Tidur</h3>
            <img src="../assets/img/kurangtidur.jpg" alt="Kurang Tidur Icon">
            <p>Kurang tidur mengganggu hormon nafsu makan dan menurunkan aktivitas fisik.</p>
        </div>
    </div>
    </section>

    <!-- Section: Risiko Penyakit Obesitas -->
    <section>
        <div class="section-title-wrapper">
            <h2 class="section-title">Risiko Penyakit Obesitas</h2>
        </div>
        <div class="cards-grid">
            <div class="info-card">
                <h3>Jantung</h3>
                <img src="../assets/img/jantung.jpg" alt="Jantung Icon">
                <p>Obesitas membebani jantung dan memaksa otot jantung bekerja lebih keras untuk memompa darah.</p>
            </div>
                <div class="info-card">
                <h3>Kanker</h3>
                <img src="../assets/img/kanker.png" alt="Kanker Icon">
                <p>Obesitas dapat memicu peradangan dan gangguan hormon yang mendorong pertumbuhan sel kanker.</p>
            </div>
            <div class="info-card">
                <h3>Stroke</h3>
                <img src="../assets/img/stroke.png" alt="Stroke Icon">
                <p>Obesitas memicu hipertensi dan stroke melalui peningkatan aktivitas sistem saraf simpatik.</p>
            </div>
            <div class="info-card">
                <h3>Diabetes</h3>
                <img src="../assets/img/diabetes.jpg" alt="Diabetes Icon">
                <p>Kadar insulin dan glukosa terganggu pada obesitas, meningkatkan risiko Diabetes Mellitus.</p>
            </div>
            <div class="info-card">
                <h3>Hipertensi</h3>
                <img src="../assets/img/hipertensi.jpg" alt="Hipertensi Icon">
                <p>Volume darah meningkat pada obesitas sehingga tekanan darah cenderung lebih tinggi.</p>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <p>&copy; 2025. RiskObesity - Syahrina</p>
</footer>
</body>
</html>
