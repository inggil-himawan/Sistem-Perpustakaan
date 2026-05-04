<?php
require_once 'database.php';

// Cek apakah ada ID di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?error=ID Anggota tidak valid");
    exit();
}

$id_anggota = (int)$_GET['id'];

// Ambil data anggota untuk pesan konfirmasi + foto
$stmt = $conn->prepare("SELECT nama, foto FROM anggota WHERE id_anggota = ?");
$stmt->bind_param("i", $id_anggota);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $stmt->close();
    closeConnection();
    header("Location: index.php?error=Anggota tidak ditemukan");
    exit();
}

$anggota = $result->fetch_assoc();
$nama = $anggota['nama'];
$foto = $anggota['foto'];
$stmt->close();

// Hapus transaksi terkait dulu (foreign key)
$stmt = $conn->prepare("DELETE FROM transaksi WHERE id_anggota = ?");
$stmt->bind_param("i", $id_anggota);
$stmt->execute();
$stmt->close();

// Proses delete anggota
$stmt = $conn->prepare("DELETE FROM anggota WHERE id_anggota = ?");
$stmt->bind_param("i", $id_anggota);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $stmt->close();

        // Hapus foto jika ada
        if (!empty($foto)) {
            $foto_path = '../../uploads/anggota/' . $foto;
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }
        }

        closeConnection();
        header("Location: index.php?success=" . urlencode("Anggota '$nama' berhasil dihapus"));
        exit();
    } else {
        $stmt->close();
        closeConnection();
        header("Location: index.php?error=Gagal menghapus data");
        exit();
    }
} else {
    $error = $stmt->error;
    $stmt->close();
    closeConnection();
    header("Location: index.php?error=" . urlencode("Error database: $error"));
    exit();
}
?>