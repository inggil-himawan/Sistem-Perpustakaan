<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Status Peminjaman - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Status Peminjaman Buku</h1>
        
        <?php
            $nama_anggota = "Budi Santoso";
            $total_pinjaman = 16;
            $buku_terlambat = 3;
            $hari_keterlambatan = 25; // hari

            $total_denda = $buku_terlambat * $hari_keterlambatan * 1000;

            if ($total_denda > 50000) {
                $total_denda = 50000;
            }

            // Cek Apakah bisa pinjam lagi
            $bisa_pinjam = "";
            if ($buku_terlambat > 0 || $total_pinjaman > 3) {
                $bisa_pinjam = "Tidak";
            } else {
                $bisa_pinjam = "Ya";
            }

            // Menentukan level member
            switch (true) {
                case $total_pinjaman >= 0 && $total_pinjaman < 6:
                    $level_member = "Brown";
                    break;
                case $total_pinjaman >= 6 && $total_pinjaman < 16:
                    $level_member = "Silver";
                    break;
                case $total_pinjaman >= 16:
                    $level_member = "Gold";
                    break;
                default:
                    break;
            }
        ?>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informasi Anggota</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>                           
                                <th width="250">Nama Anggota</th>
                                <td>: <?php echo $nama_anggota; ?></td>
                            </tr>
                            <tr>
                                <th>Bisa Pinjam</th>
                                <td>: <?php echo $bisa_pinjam; ?></td>
                            </tr>
                            <tr>
                                <th>Level Member</th>
                                <td>: <?php echo $level_member; ?></td>
                            </tr>
                        </table>
                        
                        <?php if ($buku_terlambat > 0 || $hari_keterlambatan > 0): ?>
                        <div class="alert alert-danger">
                            <strong>Peringatan!</strong> Anda terlambat mengembalikan buku.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Informasi Pinjam</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Member boleh pinjam maksimal 3 buku
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Denda keterlambatan: Rp 1.000/hari/buku
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-info-circle text-info"></i>
                                Maksimal denda: Rp 50.000
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-info-circle text-info"></i>
                                Jika ada buku terlambat, tidak bisa pinjam lagi
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-info-circle text-info"></i>
                                Jika pinjaman sudah 3, tidak bisa pinjam lagi
                            </li>
                        </ul>
                    </div>
                </div>

                
                
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Total Peminjaman</th>
                                <td>: <?php echo $total_pinjaman; ?> buku</td>
                            </tr>
                            <tr>
                                <th>Buku Terlambat</th>
                                <td>: <?php echo $buku_terlambat; ?> buku</td>
                            </tr>
                            <tr>
                                <th>Hari Keterlambatan</th>
                                <td>: <?php echo $hari_keterlambatan; ?> hari</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-warning mt-3">
                    <div class="card-header bg-warning">
                        <h6 class="mb-0">Total Denda</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="text-success">
                            Rp <?php echo number_format($total_denda, 0, ',', '.'); ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>