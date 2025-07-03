<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Classification Report - RiskObesity</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
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
    <h1>Classification Report - Naive Bayes</h1>

    <?php
    $csvFile = fopen("../assets/classification_report.csv", "r");
    if ($csvFile !== FALSE) {
        echo "<table class='report-table'>";
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            echo "<tr>";
            if (strtolower(trim($row[0])) == "accuracy") {
                // Baris akurasi: precision & recall kosong
                echo "<td><strong>".$row[0]."</strong></td>";
                echo "<td></td><td></td>";
                // f1-score pakai nilai akurasi
                echo "<td><strong>".number_format((float)$row[3], 2)."</strong></td>";
                // support isi 22
                echo "<td><strong>22</strong></td>";
            } else {
                foreach ($row as $i => $cell) {
                    // Format angka 2 desimal jika numeric
                    if (is_numeric($cell)) {
                        echo "<td>".number_format((float)$cell, 2)."</td>";
                    } else {
                        echo "<td>".htmlspecialchars($cell)."</td>";
                    }
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        fclose($csvFile);
    } else {
        echo "<p>Classification report belum tersedia.</p>";
    }
    ?>


</main>

<footer class="footer">
    <p>&copy; 2025 RiskObesity - Syahrina</p>
</footer>

</body>
</html>
