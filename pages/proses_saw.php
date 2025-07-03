<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config/koneksi.php';

// Input user (1-10)
$stres    = $_POST['stres'];
$tidur    = $_POST['tidur'];
$merokok  = $_POST['merokok'];
$makan    = $_POST['makan'];
$olahraga = $_POST['olahraga'];
$id       = $_POST['id'];

// Ambil bobot penyakit dari database (skala 0-100), ubah ke 0-1 saat load
$sql = mysqli_query($koneksi, "SELECT * FROM data_bobot_penyakit");
if (!$sql || mysqli_num_rows($sql) == 0) {
    echo "Data bobot penyakit belum tersedia!";
    exit;
}

// Simpan bobot ke array
$data = [];
while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = [
        'penyakit' => $row['penyakit'],
        'merokok'  => $row['merokok'] / 100,
        'stres'    => $row['stres'] / 100,
        'tidur'    => $row['tidur'] / 100,
        'makan'    => $row['makan'] / 100,
        'olahraga' => $row['olahraga'] / 100
    ];
}

// Buat matriks keputusan: bobot × nilai user
$keputusan = [];
foreach ($data as $row) {
    $keputusan[$row['penyakit']] = [
        'stres'    => $row['stres']    * $stres,
        'tidur'    => $row['tidur']    * $tidur,
        'merokok'  => $row['merokok']  * $merokok,
        'makan'    => $row['makan']    * $makan,
        'olahraga' => $row['olahraga'] * $olahraga
    ];
}

// Divider normalisasi
$divider = [
    'stres'    => min(array_column($keputusan, 'stres')),     // cost
    'tidur'    => min(array_column($keputusan, 'tidur')),     // cost
    'merokok'  => min(array_column($keputusan, 'merokok')),   // cost
    'makan'    => min(array_column($keputusan, 'makan')),     // cost
    'olahraga' => max(array_column($keputusan, 'olahraga'))   // benefit
];

// Normalisasi matriks keputusan
$normalisasi = [];
foreach ($keputusan as $penyakit => $nilai) {
    $normalisasi[$penyakit] = [
        'stres'    => round($divider['stres'] / $nilai['stres'], 3),
        'tidur'    => round($divider['tidur'] / $nilai['tidur'], 3),
        'merokok'  => round($divider['merokok'] / $nilai['merokok'], 3),
        'makan'    => round($divider['makan'] / $nilai['makan'], 3),
        'olahraga' => round($nilai['olahraga'] / $divider['olahraga'], 3)
    ];
}

// Hitung nilai akhir tiap alternatif
$hasil = [];
foreach ($normalisasi as $penyakit => $nilai) {
    // ambil bobot asli per penyakit
    $row = array_filter($data, function($v) use ($penyakit) {
        return $v['penyakit'] == $penyakit;
    });
    $row = array_values($row)[0];

    $nilai_akhir = (
        ($nilai['stres']    * $row['stres']) +
        ($nilai['tidur']    * $row['tidur']) +
        ($nilai['merokok']  * $row['merokok']) +
        ($nilai['makan']    * $row['makan']) +
        ($nilai['olahraga'] * $row['olahraga'])
    );

    $hasil[$penyakit] = round($nilai_akhir, 3);
}

// Urutkan nilai akhir descending
arsort($hasil);

// Simpan ke tabel hasil_saw
$peringkat = 1;
foreach ($hasil as $penyakit => $nilai) {
    $query = "INSERT INTO hasil_saw (id_bmi, penyakit, nilai, ranking)
              VALUES ('$id', '$penyakit', '$nilai', '$peringkat')";
    mysqli_query($koneksi, $query);
    $peringkat++;
}

// Simpan ke session
$_SESSION['keputusan']   = $keputusan;
$_SESSION['divider']     = $divider;
$_SESSION['normalisasi'] = $normalisasi;
$_SESSION['hasil']       = $hasil;
$_SESSION['id']          = $id;

// Redirect ke hasil saw
header("Location: hasil_saw.php");
exit;
?>
