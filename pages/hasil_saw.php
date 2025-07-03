<?php

session_start();

if (!isset($_SESSION['hasil']) || !isset($_SESSION['normalisasi'])) {
    header("Location: risk_check.php");
    exit;
}
include '../config/helper.php';

$hasil        = $_SESSION['hasil'];
$normalisasi  = $_SESSION['normalisasi'];
$id           = $_SESSION['id'];
$keputusan    = $_SESSION['keputusan'];
$divider      = $_SESSION['divider'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil SAW - RiskObesity</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #2B3467;
            color: #fff;
        }
        h2 {
            color: #2B3467;
            text-align: center;
        }
        h3{
            color: #2B3467; 
        }
        .container {
            width: 85%;
            margin: 40px auto;
            font-family: 'Poppins', sans-serif;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #3AB34A;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
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

<div class="container">
    <h2>Hasil SAW Risiko Penyakit Akibat Obesitas</h2>
    <p><strong>ID BMI:</strong> <?= formatIdBmi($id) ?></p>


    <h3>Matriks Keputusan</h3>
    <table>
        <tr>
            <th>Penyakit</th>
            <th>Stres</th>
            <th>Tidur</th>
            <th>Merokok</th>
            <th>Makan</th>
            <th>Olahraga</th>
        </tr>
        <?php foreach($keputusan as $penyakit => $nilai): ?>
        <tr>
            <td><?= htmlspecialchars($penyakit) ?></td>
            <td><?= $nilai['stres'] ?></td>
            <td><?= $nilai['tidur'] ?></td>
            <td><?= $nilai['merokok'] ?></td>
            <td><?= $nilai['makan'] ?></td>
            <td><?= $nilai['olahraga'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Divider Normalisasi</h3>
    <table>
        <tr>
            <th>Kriteria</th>
            <th>Nilai</th>
        </tr>
        <?php foreach($divider as $kriteria => $nilai): ?>
        <tr>
            <td><?= ucfirst($kriteria) ?></td>
            <td><?= $nilai ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Normalisasi Matriks Keputusan</h3>
    <table>
        <tr>
            <th>Penyakit</th>
            <th>Stres</th>
            <th>Tidur</th>
            <th>Merokok</th>
            <th>Makan</th>
            <th>Olahraga</th>
        </tr>
        <?php foreach($normalisasi as $penyakit => $nilai): ?>
        <tr>
            <td><?= htmlspecialchars($penyakit) ?></td>
            <td><?= $nilai['stres'] ?></td>
            <td><?= $nilai['tidur'] ?></td>
            <td><?= $nilai['merokok'] ?></td>
            <td><?= $nilai['makan'] ?></td>
            <td><?= $nilai['olahraga'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Nilai Akhir & Peringkat</h3>
    <table>
        <tr>
            <th>Penyakit</th>
            <th>Hasil Akhir</th>
            <th>Peringkat</th>
        </tr>
        <?php 
        $peringkat = 1;
        foreach($hasil as $penyakit => $nilai): ?>
        <tr>
            <td><?= htmlspecialchars($penyakit) ?></td>
            <td><?= $nilai ?></td>
            <td><?= $peringkat++ ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="dashboard.php" class="btn">Kembali ke Dashboard</a>
</div>

</body>
</html>
