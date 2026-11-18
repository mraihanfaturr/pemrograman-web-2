<?php
// 1. KONEKSI KE DATABASE
$host = "localhost";
$user = "root";
$pass = "";
$db   = "calon_mhs"; // Sesuai nama database baru kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// 2. PROSES SIMPAN KE DATABASE
$pesan = "";
if (isset($_POST['simpan'])) {
    $kode           = mysqli_real_escape_string($koneksi, $_POST['kode']);
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $ttl            = mysqli_real_escape_string($koneksi, $_POST['ttl']);
    $asal_sekolah   = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
    $pekerjaan_ortu = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ortu']);
    
    // Nilai-nilai ujian
    $matematika     = (float) $_POST['matematika'];
    $inggris        = (float) $_POST['inggris'];
    $umum           = (float) $_POST['umum'];
    
    // Hitung rata-rata otomatis
    $rata_rata      = ($matematika + $inggris + $umum) / 3;
    
    // Tentukan keterangan otomatis (contoh: jika rata-rata >= 75 Lulus, jika tidak Tidak Lulus)
    $keterangan     = ($rata_rata >= 75) ? "Lulus" : "Tidak Lulus";

    $query = "INSERT INTO calon_mhs (kode, nama, jenis_kelamin, ttl, asal_sekolah, pekerjaan_ortu, matematika, inggris, umum, rata_rata, keterangan) 
              VALUES ('$kode', '$nama', '$jenis_kelamin', '$ttl', '$asal_sekolah', '$pekerjaan_ortu', '$matematika', '$inggris', '$umum', '$rata_rata', '$keterangan')";
    
    if (mysqli_query($koneksi, $query)) {
        $pesan = "<div style='color: green; margin-bottom: 15px;'>Data calon mahasiswa berhasil disimpan!</div>";
    } else {
        $pesan = "<div style='color: red; margin-bottom: 15px;'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Calon Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f6f9; }
        .container { max-width: 950px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        h2 { color: #333; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .form-group { margin-bottom: 12px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; font-size: 14px; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 7px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #007bff; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 4px; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 13px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>

    <!-- FORMULIR INPUT HTML (Poin 25) -->
    <div class="container">
        <h2>Formulir Calon Mahasiswa</h2>
        <?php echo $pesan; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label>Kode Pendaftaran:</label>
                <input type="text" name="kode" placeholder="Contoh: PMB001" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <select name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tempat, Tanggal Lahir:</label>
                <input type="text" name="ttl" placeholder="Contoh: Jakarta, 12 Januari 2005" required>
            </div>
            <div class="form-group">
                <label>Asal Sekolah:</label>
                <input type="text" name="asal_sekolah" required>
            </div>
            <div class="form-group">
                <label>Pekerjaan Orang Tua:</label>
                <input type="text" name="pekerjaan_ortu">
            </div>
            <div class="form-group">
                <label>Nilai Matematika:</label>
                <input type="number" step="0.01" name="matematika" required>
            </div>
            <div class="form-group">
                <label>Nilai Bahasa Inggris:</label>
                <input type="number" step="0.01" name="inggris" required>
            </div>
            <div class="form-group">
                <label>Nilai Tes Umum:</label>
                <input type="number" step="0.01" name="umum" required>
            </div>
            <button type="submit" name="simpan">Simpan Data</button>
        </form>
    </div>

    <!-- OUTPUT TABEL HTML + PHP (Poin 25) -->
    <div class="container">
        <h2>Data Calon Mahasiswa Terdaftar</h2>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>TTL</th>
                        <th>Asal Sekolah</th>
                        <th>Pekerjaan Ortu</th>
                        <th>Matematika</th>
                        <th>Inggris</th>
                        <th>Umum</th>
                        <th>Rata-rata</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $ambil_data = mysqli_query($koneksi, "SELECT * FROM calon_mhs ORDER BY id DESC");
                    
                    if (mysqli_num_rows($ambil_data) > 0) {
                        while ($row = mysqli_fetch_assoc($ambil_data)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['kode']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ttl']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['asal_sekolah']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['pekerjaan_ortu']) . "</td>";
                            echo "<td>" . $row['matematika'] . "</td>";
                            echo "<td>" . $row['inggris'] . "</td>";
                            echo "<td>" . $row['umum'] . "</td>";
                            echo "<td>" . $row['rata_rata'] . "</td>";
                            echo "<td><b>" . $row['keterangan'] . "</b></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12' style='text-align: center;'>Belum ada data pendaftar.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>