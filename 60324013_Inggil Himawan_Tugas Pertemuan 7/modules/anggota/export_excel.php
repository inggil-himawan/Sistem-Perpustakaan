<?php
require_once 'database.php';

// Filter opsional
$where = "WHERE 1=1";
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $where .= " AND status = '$status'";
}
if (isset($_GET['jenis_kelamin']) && !empty($_GET['jenis_kelamin'])) {
    $jk = mysqli_real_escape_string($conn, $_GET['jenis_kelamin']);
    $where .= " AND jenis_kelamin = '$jk'";
}

$query = "SELECT kode_anggota, nama, email, telepon, alamat, tanggal_lahir, jenis_kelamin, pekerjaan, tanggal_daftar, status FROM anggota $where ORDER BY created_at DESC";
$result = $conn->query($query);

// Header Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="data_anggota_' . date('Ymd_His') . '.xls"');
header('Cache-Control: max-age=0');
?>
<table border="1">
    <thead>
        <tr style="background-color:#4472C4; color:white; font-weight:bold;">
            <th>No</th>
            <th>Kode Anggota</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Pekerjaan</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kode_anggota']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['telepon']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['tanggal_lahir']; ?></td>
            <td><?php echo $row['jenis_kelamin']; ?></td>
            <td><?php echo $row['pekerjaan']; ?></td>
            <td><?php echo $row['tanggal_daftar']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php closeConnection(); ?>