<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>
        
        <?php
        // Data pembeli dan data buku
        $nama_pembeli = "Budi Santoso";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 10;
        $is_member = true;
        
        // Perhitungan
        $subtotal = $harga_satuan * $jumlah_beli;
        
        // Diskon berdasarkan jumlah
        if ($jumlah_beli >= 3 && $jumlah_beli <= 5) {
            $persentase_diskon = 10; // 10%
        } else if ($jumlah_beli >= 6 && $jumlah_beli <= 10) {
            $persentase_diskon = 15; // 15%
        } else if ($jumlah_beli > 10) {
            $persentase_diskon = 20; // 20%
        } else {
            $persentase_diskon = 0;
        }
        
        // Hitung diskon
        $diskon = $subtotal * ($persentase_diskon / 100);

        // Total setelah diskon pertama
        $total_setelah_diskon1 = $subtotal - $diskon;

        // Diskon member
        if ($is_member == false) {
            $persentase_diskon_member = 0;
            $diskon_member = 0;
            
        }else {
            $persentase_diskon_member = 5;
            $diskon_member = $total_setelah_diskon1 * ($persentase_diskon_member / 100);
        }
        
        // Total setelah semua diskon
        $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;

        // PPN 11%
        $ppn = $total_setelah_diskon * 0.11;
        
        // Total akhir
        $total_akhir = $total_setelah_diskon + $ppn;

        // Total Penghematan
        $total_hemat = $diskon + $diskon_member;
        ?>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Pembelian</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr class="text-success">                           
                                <th width="250">Judul Buku</th>
                                <td>: <?php echo $judul_buku; ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Harga Satuan</th>
                                <td>: Rp <?php echo number_format($harga_satuan, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Beli</th>
                                <td>: <?php echo $jumlah_beli; ?> buku</td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Subtotal</th>
                                <td>: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="text-success">
                                <th>Diskon (<?php echo $persentase_diskon; ?>%)</th>
                                <td>: - Rp <?php echo number_format($diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Total Setelah Diskon</th>
                                <td>: Rp <?php echo number_format($total_setelah_diskon1, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="text-success">
                                <th>Diskon Member(<?php echo $persentase_diskon_member; ?>%)</th>
                                <td>: - Rp <?php echo number_format($diskon_member, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-secondary">
                                <th>Total Setelah Diskon Member</th>
                                <td>: Rp <?php echo number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>PPN 11%</th>
                                <td>: + Rp <?php echo number_format($ppn, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="table-primary fw-bold">
                                <th>TOTAL AKHIR</th>
                                <td>: Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Informasi Diskon</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 1 - 2 buku: Tidak ada diskon
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 3 - 5 buku: Diskon 10%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli 6 - 10 buku: Diskon 15%
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success"></i>
                                Beli > 10 buku: Diskon 20%
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="card border-warning mt-3">
                    <div class="card-header bg-warning">
                        <h6 class="mb-0">Hemat Anda</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="text-success">
                            Rp <?php echo number_format($total_hemat, 0, ',', '.'); ?>
                        </h4>
                        <small class="text-muted">
                            dari harga normal Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>