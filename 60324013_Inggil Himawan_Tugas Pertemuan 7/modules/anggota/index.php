<?php
$page_title = "Data Anggota";
require_once 'database.php';
require_once 'header.php';

// Statistik
$stat = $conn->query("SELECT 
    COUNT(*) as total,
    SUM(status = 'Aktif') as aktif,
    SUM(status = 'Nonaktif') as nonaktif,
    SUM(jenis_kelamin = 'Laki-laki') as laki,
    SUM(jenis_kelamin = 'Perempuan') as perempuan
    FROM anggota")->fetch_assoc();

// Filter
$where = "WHERE 1=1";
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $filter_status = mysqli_real_escape_string($conn, $_GET['status']);
    $where .= " AND status = '$filter_status'";
}
if (isset($_GET['jenis_kelamin']) && !empty($_GET['jenis_kelamin'])) {
    $filter_jk = mysqli_real_escape_string($conn, $_GET['jenis_kelamin']);
    $where .= " AND jenis_kelamin = '$filter_jk'";
}

$query = "SELECT * FROM anggota $where ORDER BY created_at DESC";
$result = $conn->query($query);

?>

    
<main class="py-4">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h2><i class="bi bi-book"></i> Data Anggota Perpustakaan</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Anggota Baru
                </a>
            </div>
        </div>
        
        <?php
        // Tampilkan pesan success/error
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show">';
            echo '<i class="bi bi-check-circle"></i> ' . htmlspecialchars($_GET['success']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
        }
        
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show">';
            echo '<i class="bi bi-x-circle"></i> ' . htmlspecialchars($_GET['error']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            echo '</div>';
        }
        ?>
        
        <!-- Statistik Dashboard -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <h3><?php echo $stat['total']; ?></h3>
                        <p class="mb-0">Total Anggota</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <h3><?php echo $stat['aktif']; ?></h3>
                        <p class="mb-0">Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body text-center">
                        <h3><?php echo $stat['nonaktif']; ?></h3>
                        <p class="mb-0">Nonaktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body text-center">
                        <h3><?php echo $stat['laki']; ?> / <?php echo $stat['perempuan']; ?></h3>
                        <p class="mb-0">L / P</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Export -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Filter Status</label>
                        <select name="status" class="form-control">
                            <option value="">-- Semua Status --</option>
                            <option value="Aktif" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="Nonaktif" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filter Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Semua --</option>
                            <option value="Laki-laki" <?php echo (isset($_GET['jenis_kelamin']) && $_GET['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo (isset($_GET['jenis_kelamin']) && $_GET['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php" class="btn btn-secondary w-100">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="export_excel.php?<?php echo http_build_query($_GET); ?>" class="btn btn-success w-100">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Anggota</h5>
            </div>
            <div class="card-body">
                <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = $result->fetch_assoc()): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo htmlspecialchars($row['kode_anggota']); ?></code></td>
                                <td>
                                    <?php if (!empty($row['foto'])): ?>
                                        <img src="/tugas/perpustakaan/uploads/anggota/<?php echo htmlspecialchars($row['foto']); ?>" 
                                            width="60" height="60" 
                                            style="object-fit: cover; border-radius: 50%;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['telepon']); ?></td>
                                <td>
                                    <span class="badge bg-primary">
                                        <?php echo htmlspecialchars($row['jenis_kelamin']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['tanggal_daftar']); ?></td>
                                    <td class="text-center">
                                    <?php if ($row['status'] == "Aktif"): ?>
                                        <span class="badge bg-success"><?php echo $row['status']; ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id_anggota']; ?>" 
                                    class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id_anggota']; ?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="alert alert-info mt-3 mb-0">
                    <i class="bi bi-info-circle"></i> 
                    <strong>Total:</strong> <?php echo $result->num_rows; ?> buku terdaftar
                </div>
                
                <?php else: ?>
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle"></i> 
                    Belum ada data buku. Silakan tambah buku baru.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
closeConnection();
require_once 'footer.php';
?>