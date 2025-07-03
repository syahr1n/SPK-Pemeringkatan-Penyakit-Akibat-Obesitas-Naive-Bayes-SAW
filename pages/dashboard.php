<?php
// Mulai session kalau belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - RiskObesity</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div id="loading-overlay">
        <div class="dots-loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
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
                <h1>SPK Pemeringkatan Risiko Akibat Penyakit Obesitas</h1>
                <p>menggunakan Metode <strong>Naive Bayes</strong> dan <strong>SAW</strong></p>

                <h3>Apa itu Obesitas?</h3>
                <p class ="justify">
                    Obesitas adalah peningkatan berat badan melebihi batas kebutuhan skeletal dan fisik 
                    sebagai akibat dari akumulasi lemak berlebihan dalam tubuh yang berisiko adanya 
                    penyakit seperti jantung, stroke, diabetes, dan kanker. Sistem ini akan mengecek status BMI 
                    Anda dan membantu pemeringkatan risiko akibat penyakit obesitas berdasarkan pola gaya hidup.
                </p>

                <a href="bmi.php" class="btn">Start Now</a>
                <a href="classification_report.php" class="btn-yellow" style="margin-top: 10px;">Lihat Classification Report</a>
            </div>
            <div class="card-image">
                <img src="../assets/img/obese.png" alt="Obesity Illustration">
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025. RiskObesity - Syahrina</p>
    </footer>
    <script>
        window.addEventListener("load", function(){
            const overlay = document.getElementById("loading-overlay");
            overlay.style.opacity = "0";
            setTimeout(() => { overlay.style.display = "none"; }, 300);
        });

        const links = document.querySelectorAll("a");
        links.forEach(link => {
            link.addEventListener("click", function(e){
                const href = this.getAttribute("href");
                if(href && !href.startsWith("#") && !href.startsWith("javascript")) {
                    e.preventDefault();
                    const overlay = document.getElementById("loading-overlay");
                    overlay.style.display = "flex";
                    overlay.style.opacity = "1";
                    setTimeout(() => { window.location.href = href; }, 200);
                }
            });
        });
    </script>
</body>
</html>
